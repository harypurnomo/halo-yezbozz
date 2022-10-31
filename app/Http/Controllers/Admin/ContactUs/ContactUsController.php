<?php

namespace App\Http\Controllers\Admin\ContactUs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\ContactUs;
use Validator;
use Auth;
use Str;

class ContactUsController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-contactus';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.contactus.index')->with('recContactUs',ContactUs::getAll()->get());
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.contactus.edit')->with('recContactUsByID',ContactUs::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());

        $rules=[
            'name'=>'required|min:5|max:100',
            'phone_number'=>'required|min:8|max:30',
            'email'=>'required|min:5|max:100',
            'subject'=>'required',
            'message'=>'required',
            'is_spam'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-contactus.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = ContactUs::find($id);
        $rec->name = trim($request->input('name'));
        $rec->phone_number = trim($request->input('phone_number'));
        $rec->email = trim($request->input('email'));
        $rec->subject = $request->input('subject');
        $rec->message = $request->input('message');
        $rec->is_spam = $request->input('is_spam');
        $rec->save();

        return redirect(route('master-contactus.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // dd($id);
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = ContactUs::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
