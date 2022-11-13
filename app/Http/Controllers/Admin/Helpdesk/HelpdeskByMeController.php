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

class HelpdeskByMeController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/open-ticket-by-me';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.helpdesk.indexByMe')
        ->with('recHelpdeskIsParent',Helpdesk::getIsParentByMe(Auth::user()->id,Auth::user()->group_id)->get());
    }

    public function show($id)
    {
        // dd($id);
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        // get helpdesk list by id
        $getHelpdesk = Helpdesk::find(base64_decode($id));

        // update helpdesk list by uuid
        $update = Helpdesk::where('uuid',$getHelpdesk->uuid)->firstOrFail();
        $update->is_read_member = 1;
        $update->save();

        return view('admin.helpdesk.showByMe')
        ->with('recHelpdeskById',Helpdesk::getByID(base64_decode($id))->get())
        ->with('recHelpdeskByUUID',Helpdesk::getByUUID($getHelpdesk->uuid)->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.helpdesk.createByMe')
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
          return redirect(route('open-ticket-by-me.create'))->withErrors($validation)->withInput();
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

        $data = [
                'sender_name'=>$request->input('sender_name'),
                'sender_email'=>$request->input('sender_email'),
                'receiver_name'=>$arr[2],
                'receiver_email'=>$arr[3],
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

        return redirect(route('open-ticket-by-me.index'))->with('success-update','Your work has been saved!');
    }

    public function reply($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.helpdesk.replyByMe')
        ->with('recHelpdeskById',Helpdesk::find(base64_decode($id)));
    }

    public function update($id, Request $request)
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
          return redirect(route('open-ticket-by-me.reply',['id'=>base64_encode($id)]))->withErrors($validation)->withInput();
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

        return redirect(route('open-ticket-by-me.show',['id'=>base64_encode($id)]))->with('success-update','Your work has been saved!');
    }

}
