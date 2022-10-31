<?php

namespace App\Http\Controllers\Admin\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Tenants;
use App\TenantsType;
use App\TenantsRepresentative;
use Validator;
use Auth;
use Str;

class TenantByMeController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-tenant-by-me';
    }

    public function index()
    {   
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.tenant.indexByMe')
            ->with('recTenants',Tenants::getAllByMe(Auth::user()->id)->get());
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.tenant.editByMe')
        ->with('recTenantsByID',Tenants::find(base64_decode($id)))
        ->with('recTenantsType',TenantsType::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());

        $rules=[
            'name'=>'required|min:5|max:50',
            'address'=>'required',
            'email'=>'required',
            'phone'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-tenant-by-me.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Tenants::find($id);        
        $rec->name = trim($request->input('name')); 
        $rec->address = trim($request->input('address')); 
        $rec->email = trim($request->input('email')); 
        $rec->phone = trim($request->input('phone')); 
        $rec->fax = trim($request->input('fax')); 
        $rec->description = trim($request->input('description')); 
        
        //Tenant
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/tenants');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-tenant-by-me.index'))->with('success-update','Your work has been saved!');
    }

}
