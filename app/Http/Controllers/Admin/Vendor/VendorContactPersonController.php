<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Vendors;
use App\VendorContactPerson;
use Validator;
use Auth;
use Str;

class VendorContactPersonController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-vendor-contact';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.vendor.contact.index')->with('recVendorContactPerson',VendorContactPerson::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.vendor.contact.create')->with('recVendor',Vendors::getAllIsActive()->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        // exit();

        $rules=[
            'name'=>'required|min:3|max:100',
            'position'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-vendor-contact.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new VendorContactPerson;
        $rec->vendor_id = $request->input('vendor_id');
        $rec->name = trim($request->input('name'));
        $rec->position = trim($request->input('position'));
        $rec->email = trim($request->input('email'));
        $rec->phone = trim($request->input('phone'));
        $rec->created_by = $request->input('created_by');

        //Avatar
        if( $request->has('avatar') ) {
            $file = $request->file('avatar');
            $fileName = time().Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/vendor/contact/avatar');
            $file->move($destinationPath,$fileName);
            $rec->avatar = $fileName;
        }

        //KTP
        if( $request->has('ktp') ) {
            $file = $request->file('ktp');
            $fileName = time().Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/vendor/contact/ktp');
            $file->move($destinationPath,$fileName);
            $rec->ktp = $fileName;
        }

        $rec->save();

        return redirect(route('master-vendor-contact.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.vendor.contact.edit')
        ->with('recVendor',Vendors::getAllIsActive()->get())
        ->with('recVendorContactPersonByID',VendorContactPerson::find($id));
    }

    public function update($id, Request $request)
    {
        $rules=[
            'name'=>'required|min:3|max:100',
            'position'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-vendor-contact.create'))->withErrors($validation)->withInput();
        }
    
        $rec = VendorContactPerson::find($id);
        $rec->vendor_id = $request->input('vendor_id');
        $rec->name = trim($request->input('name'));
        $rec->position = trim($request->input('position'));
        $rec->email = trim($request->input('email'));
        $rec->phone = trim($request->input('phone'));
        $rec->updated_by = $request->input('updated_by');

        //Avatar
        if( $request->has('avatar') ) {
            $file = $request->file('avatar');
            $fileName = time().Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/vendor/contact/avatar');
            $file->move($destinationPath,$fileName);
            $rec->avatar = $fileName;
        }

        //KTP
        if( $request->has('ktp') ) {
            $file = $request->file('ktp');
            $fileName = time().Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/vendor/contact/ktp');
            $file->move($destinationPath,$fileName);
            $rec->ktp = $fileName;
        }

        $rec->save();

        return redirect(route('master-vendor-contact.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = VendorContactPerson::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
