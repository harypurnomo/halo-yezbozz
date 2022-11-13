<?php

namespace App\Http\Controllers\Admin\TenantRepresentative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\TenantsRepresentative;
use App\TenantsRepresentativeDetail;
use App\Tenants;
use App\User;
use Validator;
use Auth;
use Str;

class TenantRepresentativeController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-tenant-representative';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        $recTenantRepresentative = TenantsRepresentative::getAll()->get();
        foreach ($recTenantRepresentative as $key => $item) {
            $recTenant = TenantsRepresentativeDetail::getAll(['a.user_id'=>$item->user_id])->get();
            $recTenantRepresentative[$key]->tenant = $recTenant;
        }

        return view('admin.tenantrepresentative.index')
        ->with('recTenantsRepresentative',$recTenantRepresentative);
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.tenantrepresentative.create')
        ->with('recTenants',Tenants::where('is_active',1)->get())
        ->with('recUser',User::where('is_active',1)->get());
    }

    public function store(Request $request)
    {    	
        // dd($request->all());

        $rules=[
            'tenant'=>'required',
            'user_id'=>'required|unique:tenant_representative,user_id',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
            return redirect(route('master-tenant-representative.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new TenantsRepresentative;
        // $rec->tenant_id = $request->input('tenant_id');
        $rec->user_id = $request->input('user_id');
        $rec->description = trim($request->input('description'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        // Insert Tenant Representative Detail
        $tenant = $request->input('tenant');
        foreach ($tenant as $tenantId) {
            $recDetail = new TenantsRepresentativeDetail;
            $recDetail->user_id = $request->input('user_id');
            $recDetail->tenant_id = $tenantId;
            $recDetail->save();
        }

        return redirect(route('master-tenant-representative.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
    	// Validate Access
        Library::validateAccess('update',$this->moduleLink);

        $recTenantsRepresentativeByID = TenantsRepresentative::find($id);
        $arrTenant = [];
        $recTenantRep = TenantsRepresentativeDetail::getAll(['a.user_id'=>$recTenantsRepresentativeByID->user_id])->get();
        foreach ($recTenantRep as $key => $item) {
            $arrTenant[$key] = $item->tenant_id;
        }

        return view('admin.tenantrepresentative.edit')
        ->with('recTenantsRepresentativeByID',$recTenantsRepresentativeByID)
        ->with('arrTenant',$arrTenant)
        ->with('recTenants',Tenants::where('is_active',1)->get())
        ->with('recUser',User::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());

        $rules=[
            'tenant'=>'required',
            'user_id'=>'required|unique:tenant_representative,user_id,'.$id,
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
            return redirect(route('master-tenant-representative.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = TenantsRepresentative::find($id);
        $rec->user_id = $request->input('user_id');
        $rec->description = trim($request->input('description'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        // Insert Tenant Representative Detail
        $tenant = $request->input('tenant');
        TenantsRepresentativeDetail::where('user_id',$request->input('user_id'))->delete();
        foreach ($tenant as $tenantId) {
            $recDetail = new TenantsRepresentativeDetail;
            $recDetail->user_id = $request->input('user_id');
            $recDetail->tenant_id = $tenantId;
            $recDetail->save();
        }

        return redirect(route('master-tenant-representative.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = TenantsRepresentative::find($id);
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
