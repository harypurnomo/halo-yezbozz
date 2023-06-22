<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Broadcast;
use App\BroadcastRecipients;
use DB;
use Session;
use Validator;

class BroadcastController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function broadcast(){
        $strBroadcastRecipients = BroadcastRecipients::where('is_status',0)->first();

        if (!empty($strBroadcastRecipients)) {
            
            $rec = BroadcastRecipients::find($strBroadcastRecipients->id);
            $rec->is_status = 1;
            $rec->save();

            $strBroadcast = Broadcast::where('uuid',$strBroadcastRecipients->broadcast_uuid)->first();

            // dd($strBroadcast->subject);

            $data = [
                'name'=>$strBroadcastRecipients->name,
                'email'=>$strBroadcastRecipients->email,
                'subject'=>$strBroadcast->subject,
                'message'=>$strBroadcastRecipients->message,
                'file_attachement'=>$strBroadcast->file_attachement
            ];

            return view('emails.broadcast')->with('row',$data);

            Mail::send('emails.broadcast', ['row'=>$data], function($message) use($data) {
                $message->from(env('MAIL_FROM_ADDRESS', 'noreply@klakklik.id'), env('MAIL_FROM_NAME', 'KLAKKLIK Team'));
                $message->to($data['email'], $data['name']);
                $message->subject($data['subject']);
                $message->priority(3);
                if($data['file_attachement'] && $data['file_attachement'] != '') {
                    $message->attach(public_path('uploads/broadcast/file_attachement/').$data['file_attachement']);
                }
            });

            return response()->json(['status'=>'1','msg'=>''], 200);

        }else{

            return response()->json(['status'=>'0','msg'=>''], 200);
        
        }
    }

}
