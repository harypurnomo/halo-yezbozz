<?php

namespace App\Http\Controllers\Admin\ContactEmail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\RecipientsAnnouncement;
use App\GroupsAnnouncement;
use Validator;
use Auth;
use Str;

class ContactEmailController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-contact-email';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.contactemail.index')->with('recRecipientsAnnouncement',RecipientsAnnouncement::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.contactemail.create')->with('recGroupsAnnouncement',GroupsAnnouncement::where('is_active',1)->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'name'=>'required|min:3',
            'email'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-contact-email.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new RecipientsAnnouncement;
        $rec->groups_announcement_id = $request->input('groups_announcement_id');
        $rec->name = trim($request->input('name'));
        $rec->email = trim($request->input('email'));
        $rec->save();

        return redirect(route('master-contact-email.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.contactemail.edit')
        ->with('recRecipientsAnnouncementByID',RecipientsAnnouncement::find($id))
        ->with('recGroupsAnnouncement',GroupsAnnouncement::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'name'=>'required|min:3',
            'email'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-contact-email.create'))->withErrors($validation)->withInput();
        }

        $rec = RecipientsAnnouncement::find($id);
        $rec->groups_announcement_id = $request->input('groups_announcement_id');
        $rec->name = trim($request->input('name'));
        $rec->email = trim($request->input('email'));
        $rec->save();

        return redirect(route('master-contact-email.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = RecipientsAnnouncement::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
