<?php

namespace App\Http\Controllers\Admin\Broadcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Broadcast;
use App\BroadcastRecipients;
use App\GroupsAnnouncement;
use App\RecipientsAnnouncement;
use App\BroadcastLink;
use App\BroadcastRecipientLinks;
use Validator;
use Auth;
use Str;

class BroadcastController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-broadcast';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.broadcast.index')
        ->with('recBroadcast',Broadcast::orderBy('updated_at','desc')->get());
    }

    public function show($id)
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        $getBroadcastID = Broadcast::where('uuid',$id)->first()->id;

        // dd($getBroadcastID);

        return view('admin.broadcast.show')
        ->with('recBroadcastByUUID',Broadcast::where('uuid',$id)->get())
        ->with('recBroadcastRecipientsByUUID',BroadcastRecipients::where('broadcast_uuid',$id)->get())
        ->with('recBroadcastRecipientsCountIsSent',BroadcastRecipients::where('broadcast_uuid',$id)->where('is_status',1)->count())
        ->with('recBroadcastRecipientsCountIsPending',BroadcastRecipients::where('broadcast_uuid',$id)->where('is_status',0)->count())
        ->with('recBroadcastRecipientLinksIsClicked',BroadcastRecipientLinks::where('broadcast_id',$getBroadcastID)->where('is_clicked',1)->count());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.broadcast.create')
        ->with('recGroupsAnnouncement',GroupsAnnouncement::where('is_active',1)->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'subject'=>'required|min:3',
            'message'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-broadcast.create'))->withErrors($validation)->withInput();
        }

        $rec = new Broadcast;
        $rec->subject = trim($request->input('subject'));
        $rec->message = trim($request->input('message'));
        $rec->uuid = time().str_random(25);

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/broadcast/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->save();
        $broadcastId = $rec->id;
        $broadcastUUID = $rec->uuid;

            // Insert Broadcast Link
            $text = trim($request->input('message'));
            preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~', $text, $matches);
            $fullHtml = $matches[0];
            $fullUrl = $matches[2];
            $attribute =  $matches[3];
            foreach ($fullHtml as $key => $item) {
                $recBroadcastLink = new BroadcastLink;
                $recBroadcastLink->broadcast_id = $broadcastId;
                $recBroadcastLink->broadcast_link = $fullUrl[$key];
                $recBroadcastLink->save();
            }

            //store in table broadcast_recipients
            $strQueryRecipients = RecipientsAnnouncement::where('groups_announcement_id',$request->input('groups_announcement_id'))->get();

            // dd($strQueryRecipients);
            foreach ($strQueryRecipients as $key => $value) {
                $recRecipientsAnnouncement = new BroadcastRecipients;
                $recRecipientsAnnouncement->broadcast_id = $broadcastId;
                $recRecipientsAnnouncement->broadcast_uuid = $broadcastUUID;
                $recRecipientsAnnouncement->name = $value->name;
                $recRecipientsAnnouncement->email = $value->email;
                $recRecipientsAnnouncement->save();
                $recipientId = $recRecipientsAnnouncement->id;

                $text = trim($request->input('message'));
                
                foreach ($fullHtml as $key => $item) {

                    $text = str_replace($item, '<a href="'.url('url-tracker?id='.$recipientId.'&url='.$fullUrl[$key]).'" '.$attribute[$key].'>', $text);

                    $recBroadcastLink = BroadcastLink::where(['broadcast_id'=>$broadcastId,'broadcast_link'=>$fullUrl[$key]])->first();

                    $recBroadcastUrl = new BroadcastRecipientLinks;
                    $recBroadcastUrl->broadcast_id = $broadcastId;
                    $recBroadcastUrl->broadcast_rec_id = $recipientId;
                    $recBroadcastUrl->broadcast_link = $fullUrl[$key];
                    $recBroadcastUrl->broadcast_link_id = $recBroadcastLink->id;
                    $recBroadcastUrl->save();
                }
                // Update Body Email 
                BroadcastRecipients::where(['id'=>$recipientId])->update(['message'=>$text]);
            }
            

        return redirect(route('master-broadcast.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Broadcast::find($id);
            $rec->delete();

            $recBroadcastRecipients = BroadcastRecipients::where('broadcast_id',$id);
            $recBroadcastRecipients->delete();

            $recBroadcastLink = BroadcastLink::where('broadcast_id',$id);
            $recBroadcastLink->delete();

            $recBroadcastRecipientLinks = BroadcastRecipientLinks::where('broadcast_id',$id);
            $recBroadcastRecipientLinks->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

    function detailLinkClick($id,$email)
    {
        $html = '';
        $recLink = BroadcastRecipients::getDetailUserClick($id,$email);
        foreach ($recLink as $key => $item) {
            $isClicked = ($item->is_clicked)?'Clicked':'';
            $clickedAt = ($item->clicked_at)?date_format(date_create($item->clicked_at),"d/m/Y H:i"):'';
            $html .= '<tr>';
            $html .= '<td>'.++$key.'</td>';
            $html .= '<td>'.$item->broadcast_link.'</td>';
            $html .= '<td>'.$isClicked.'</td>';
            $html .= '<td>'.$clickedAt.'</td>';
        }

        return response()->json(['body'=>$html], 200);
    }

}
