<?php

namespace App\Http\Controllers\Admin\Helpdesk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Helpdesk;
use App\HelpdeskCategory;
use App\HelpdeskPriority;
use Validator;
use Auth;
use Str;
use Mail;

class HelpdeskController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/open-ticket';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.helpdesk.index')
        ->with('recHelpdeskIsParent',Helpdesk::getIsParent()->get());
    }

    public function show($id)
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        // get helpdesk list by id
        $getHelpdesk = Helpdesk::find(base64_decode($id));

        // update helpdesk list by uuid
        $update = Helpdesk::where('uuid',$getHelpdesk->uuid)->firstOrFail();
        $update->is_read_admin = 1;
        $update->save();

        return view('admin.helpdesk.show')
        ->with('recHelpdeskById',Helpdesk::getByID(base64_decode($id))->get())
        ->with('recHelpdeskByUUID',Helpdesk::getByUUID($getHelpdesk->uuid)->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.helpdesk.create')
        ->with('recHelpdeskCategory',HelpdeskCategory::where('is_active',1)->get())
        ->with('recHelpdeskPriority',HelpdeskPriority::where('is_active',1)->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'sender_user_id'=>'required',
            'sender_name'=>'required',
            'sender_email'=>'required',
            'helpdesk_category_id'=>'required',
            'helpdesk_priority_id'=>'required',
            'message'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('open-ticket.create'))->withErrors($validation)->withInput();
        }

        $arr = explode('#',$request->helpdesk_category_id);
    
        $rec = new Helpdesk;
        $rec->helpdesk_category_id = $arr[0];
        $rec->helpdesk_priority_id = $request->input('helpdesk_priority_id');
        $rec->sender_user_id = $request->input('sender_user_id');
        $rec->sender_name = $request->input('sender_name');
        $rec->sender_email = $request->input('sender_email');
        $rec->receiver_user_id = $arr[1];
        $rec->receiver_name = $arr[2];
        $rec->receiver_email = $arr[3];
        $rec->message = trim($request->input('message'));
        $rec->is_parent = 1;
        $rec->is_active = 1;
        $rec->uuid = time();

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/helpdesk/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->save();

        return redirect(route('open-ticket.index'))->with('success-update','Your work has been saved!');
    }

    public function reply($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.helpdesk.reply')
        ->with('recHelpdeskById',Helpdesk::find(base64_decode($id)));
    }

    public function update($id, Request $request)
    {
        
        $rules=[
            'sender_user_id'=>'required',
            'sender_name'=>'required',
            'sender_email'=>'required',
            'helpdesk_category_id'=>'required',
            'helpdesk_priority_id'=>'required',
            'message'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('open-ticket.reply',['id'=>base64_encode($id)]))->withErrors($validation)->withInput();
        }

        $rec = new Helpdesk;
        $rec->helpdesk_category_id = $request->input('helpdesk_category_id');
        $rec->helpdesk_priority_id = $request->input('helpdesk_priority_id');
        $rec->sender_user_id = $request->input('sender_user_id');
        $rec->sender_name = $request->input('sender_name');
        $rec->sender_email = $request->input('sender_email');
        $rec->receiver_user_id = $request->input('receiver_user_id');
        $rec->receiver_name = $request->input('receiver_name');
        $rec->receiver_email = $request->input('receiver_email');
        $rec->message = trim($request->input('message'));
        $rec->is_parent = 0;
        $rec->is_active = 1;
        $rec->uuid = $request->input('uuid');

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/helpdesk/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->save();

        $update = Helpdesk::where('uuid',$request->input('uuid'))->firstOrFail();
        $update->is_read_member = 0;
        $update->is_read_admin = 0;
        $update->save();

        $data = [
                'sender_name'=>$request->input('sender_name'),
                'sender_email'=>$request->input('sender_email'),
                'receiver_name'=>$request->input('receiver_name'),
                'receiver_email'=>$request->input('receiver_email'),
                'message'=>trim($request->input('message')),
                'file_attachement'=>$rec->file_attachement
            ];

        // Mail::send('emails.open-ticket-notif', ['row'=>$data], function($message) use($data) {
        //     $message->to($data['receiver_email'], $data['receiver_name']);
        //     $message->cc($data['sender_email'], $data['sender_name']);
        //     $message->subject('Open Ticket');
        //     $message->from($data['sender_email'], $data['sender_name']);
        //     $message->priority(3);
        //     $message->attach(public_path('uploads/helpdesk/file_attachement/').$data['file_attachement']);
        // });

        return redirect(route('open-ticket.show',['id'=>base64_encode($id)]))->with('success-update','Your work has been saved!');
    }

    public function statusChange($id,$is_active)
    {
        // dd($id,$is_active);
        // Validate Access
        Library::validateAccess('approve',$this->moduleLink);

        // get helpdesk list by id
        $rec = Helpdesk::find(base64_decode($id));
        $rec->is_active = $is_active;
        $rec->save();

        return redirect(route('open-ticket.index'))->with('success-update','Your work has been saved!');
    }

}
