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

class TenantController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-tenant';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.tenant.index')
        ->with('recTenants',Tenants::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.tenant.create')
        ->with('recTenantsType',TenantsType::where('is_active',1)->orderBy('updated_at','desc')->get());
    }

    public function store(Request $request)
    {   
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:100',
            'tenant_type_id'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-tenant.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Tenants;
        $rec->name = trim($request->input('name')); 
        $rec->tenant_type_id = trim($request->input('tenant_type_id')); 
        $rec->address = trim($request->input('address')); 
        $rec->google_maps = trim($request->input('google_maps')); 
        $rec->coordinate = trim($request->input('coordinate')); 
        $rec->type = trim($request->input('type')); 
        $rec->email = trim($request->input('email')); 
        $rec->phone = trim($request->input('phone')); 
        $rec->whatsapp = trim($request->input('whatsapp')); 
        $rec->instagram = trim($request->input('instagram'));
        $rec->facebook = trim($request->input('facebook'));
        $rec->youtube = trim($request->input('youtube'));
        $rec->website_url = trim($request->input('website_url'));
        $rec->description = trim($request->input('description')); 
        $rec->is_active = $request->input('is_active');
        
        //Tenant
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/tenants');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-tenant.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.tenant.edit')
        ->with('recTenantsByID',Tenants::find($id))
        ->with('recTenantsType',TenantsType::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:100',
            'tenant_type_id'=>'required',
            'address'=>'required',
            'email'=>'required|min:5|max:100',
            'phone'=>'required|min:8|max:30',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-tenant.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Tenants::find($id);
        $rec->name = trim($request->input('name')); 
        $rec->tenant_type_id = trim($request->input('tenant_type_id')); 
        $rec->address = trim($request->input('address')); 
        $rec->google_maps = trim($request->input('google_maps')); 
        $rec->coordinate = trim($request->input('coordinate')); 
        $rec->type = trim($request->input('type')); 
        $rec->email = trim($request->input('email')); 
        $rec->phone = trim($request->input('phone')); 
        $rec->whatsapp = trim($request->input('whatsapp')); 
        $rec->instagram = trim($request->input('instagram'));
        $rec->facebook = trim($request->input('facebook'));
        $rec->youtube = trim($request->input('youtube'));
        $rec->website_url = trim($request->input('website_url'));
        $rec->description = trim($request->input('description')); 
        $rec->is_active = $request->input('is_active');
        
        //Tenant
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/tenants');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-tenant.index'))->with('success-update','Your work has been saved!');
    }

    public function update_optional($id, Request $request)
    {
        $rec = Tenants::find($id);
        $rec->instagram = trim($request->input('instagram'));
        $rec->facebook = trim($request->input('facebook'));
        $rec->youtube = trim($request->input('youtube'));
        $rec->website_url = trim($request->input('website_url'));
        $rec->description = trim($request->input('description'));
        $rec->save();

        return redirect(route('master-tenant.edit',['id'=>$id]))->withInput()->with('tab','optional');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Tenants::find($id);
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
