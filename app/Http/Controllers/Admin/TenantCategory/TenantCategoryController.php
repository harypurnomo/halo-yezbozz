<?php

namespace App\Http\Controllers\Admin\TenantCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\TenantsType;
use Validator;
use Auth;
use Str;

class TenantCategoryController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-type-of-tenant';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.tenantcategory.index')
        ->with('recTenantsType',TenantsType::where('is_remove',0)->orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.tenantcategory.create');
    }

    public function store(Request $request)
    {    	
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:50'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-type-of-tenant.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new TenantsType;
        $rec->name = trim($request->input('name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-type-of-tenant.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
    	// Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.tenantcategory.edit')->with('recTenantsTypeByID',TenantsType::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:50'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-type-of-tenant.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = TenantsType::find($id);
        $rec->name = trim($request->input('name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-type-of-tenant.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = TenantsType::find($id);
            $rec->is_active = 0;
            $rec->is_remove = 1;

            $rec->save();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
