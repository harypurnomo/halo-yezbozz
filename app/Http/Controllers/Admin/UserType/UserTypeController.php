<?php

namespace App\Http\Controllers\Admin\UserType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserType;
use Validator;
use App\Library\Library;

class UserTypeController extends Controller
{
   
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-type';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.usertype.index')->with('recUserType',UserType::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.usertype.create');
    }

    public function store(Request $request)
    {

        $rules=[
            'type_name'=>'required|min:5|max:50',
            'is_active'=>'required',
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-type.create'))->withErrors($validation)->withInput();
        }

        $rec = new UserType;
        $rec->type_name = trim($request->input('type_name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-type.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.usertype.edit')->with('recUserTypeByID',UserType::find($id));
    }

    public function update($id, Request $request)
    {
        $rules=[
            'type_name'=>'required|min:5|max:50',
            'is_active'=>'required',
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-type.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = UserType::find($id);
        $rec->type_name = trim($request->input('type_name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-type.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = UserType::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
