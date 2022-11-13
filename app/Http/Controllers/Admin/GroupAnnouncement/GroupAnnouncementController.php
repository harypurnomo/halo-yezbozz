<?php

namespace App\Http\Controllers\Admin\GroupAnnouncement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\GroupsAnnouncement;
use App\RecipientsAnnouncement;
use Validator;
use Excel;
use Auth;
use Str;
use App\Imports\RecipientsAnnouncementImport;

class GroupAnnouncementController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-group-announcement';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.groupannouncement.index')->with('recGroupsAnnouncement',GroupsAnnouncement::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.groupannouncement.create');
    }

    public function store(Request $request)
    {    	
        // dd($request->all());
        $rules=[
            'name'=>'required|min:3'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-group-announcement.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new GroupsAnnouncement;
        $rec->name = trim($request->input('name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-group-announcement.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
    	// Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.groupannouncement.edit')->with('recGroupsAnnouncementByID',GroupsAnnouncement::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'name'=>'required|min:3'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-group-announcement.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = GroupsAnnouncement::find($id);
        $rec->name = trim($request->input('name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-group-announcement.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = GroupsAnnouncement::find($id);
            $rec->delete();

            //Remove Recipients Announcement By groups_announcement_id
            RecipientsAnnouncement::where('groups_announcement_id', $id)->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

    public function recipients($groups_announcement_id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.groupannouncement.add-recipient')
        ->with('groups_announcement_id',$groups_announcement_id)
        ->with('recRecipientsAnnouncement',RecipientsAnnouncement::where('groups_announcement_id',$groups_announcement_id)->orderBy('updated_at','desc')->get());
    }

    public function storeRecipients(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'name'=>'required|min:3',
            'email'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('manage-recipients.recipients',['groups_announcement_id'=>$request->input('groups_announcement_id')]))->withErrors($validation)->withInput();
        }
    
        $rec = new RecipientsAnnouncement;
        $rec->groups_announcement_id = $request->input('groups_announcement_id');
        $rec->name = trim($request->input('name'));
        $rec->email = trim($request->input('email'));
        $rec->save();

        return redirect(route('manage-recipients.recipients',['groups_announcement_id'=>$request->input('groups_announcement_id')]))->with('success-update','Your work has been saved!');
    }

    public function destroyRecipients($id,$groups_announcement_id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = RecipientsAnnouncement::find($id);
            $rec->delete();

            return redirect(route('manage-recipients.recipients',['groups_announcement_id'=>$groups_announcement_id]))->with('success-update','Your work has been saved!');
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

    public function uploadExcel(Request $request)
    {
        // Import Data
        try 
        {
            $id = $request->input('id');
            $file = $request->file('file');
            $fileName = Str::uuid().'.'.$file->getClientOriginalExtension();
    
            $destinationPath = public_path('uploads/broadcast/temp-upload');
            $file->move($destinationPath,$fileName);

            $fileTemplate = public_path('uploads/broadcast/temp-upload/'.$fileName);

            Excel::import(new RecipientsAnnouncementImport($id), $fileTemplate);

            unlink($fileTemplate);

            return response()->json(['status'=>1,'file_name'=>$fileName], 200);
        } 
        catch (Throwable $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
