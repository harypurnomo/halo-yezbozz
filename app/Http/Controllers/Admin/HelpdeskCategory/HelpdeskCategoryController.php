<?php

namespace App\Http\Controllers\Admin\HelpdeskCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\HelpdeskCategory;
use App\User;
use Validator;
use Auth;
use Str;

class HelpdeskCategoryController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-category-of-helpdesk';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.helpdeskcategory.index')
        ->with('recHelpdeskCategory',HelpdeskCategory::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.helpdeskcategory.create')
        ->with('recUser',User::where('is_active',1)->get());
    }

    public function store(Request $request)
    {    	
        // dd($request->all());
        $rules=[
            'name'=>'required|min:3',
            'pic_user_id'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-category-of-helpdesk.create'))->withErrors($validation)->withInput();
        }

        //get detail user by ID
        $getUserByID = user::find($request->input('pic_user_id'));
    
        $rec = new HelpdeskCategory;
        $rec->name = trim($request->input('name'));
        $rec->pic_user_id = $request->input('pic_user_id');
        $rec->pic_name = $getUserByID->name;
        $rec->pic_email = $getUserByID->email;
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-category-of-helpdesk.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
    	// Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.helpdeskcategory.edit')
        ->with('recHelpdeskCategoryByID',HelpdeskCategory::find($id))
        ->with('recUser',User::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'name'=>'required|min:3',
            'pic_user_id'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-category-of-helpdesk.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        //get detail user by ID
        $getUserByID = user::find($request->input('pic_user_id'));

        $rec = HelpdeskCategory::find($id);
        $rec->name = trim($request->input('name'));
        $rec->pic_user_id = $request->input('pic_user_id');
        $rec->pic_name = $getUserByID->name;
        $rec->pic_email = $getUserByID->email;
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-category-of-helpdesk.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = HelpdeskCategory::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
