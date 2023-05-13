<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Vendors;
use App\VendorsOrderHistory;
use Validator;
use Auth;
use Str;

class VendorOrderController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-vendor-order';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.vendor.order.index')->with('recVendorOrderHisotry',VendorsOrderHistory::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.vendor.order.create')->with('recVendor',Vendors::getAllIsActive()->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        // exit();

        $rules=[
            'name'=>'required|min:3|max:100'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-vendor-order.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new VendorsOrderHistory;
        $rec->vendor_id = $request->input('vendor_id');
        $rec->name = trim($request->input('name'));
        $rec->created_by = $request->input('created_by');

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/vendor/order');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->save();

        return redirect(route('master-vendor-order.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.vendor.order.edit')
        ->with('recVendor',Vendors::getAllIsActive()->get())
        ->with('recVendorsOrderHistoryByID',VendorsOrderHistory::find($id));
    }

    public function update($id, Request $request)
    {
        $rules=[
            'name'=>'required|min:3|max:100'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-vendor-order.create'))->withErrors($validation)->withInput();
        }
    
        $rec = VendorsOrderHistory::find($id);
        $rec->vendor_id = $request->input('vendor_id');
        $rec->name = trim($request->input('name'));
        $rec->updated_by = $request->input('updated_by');

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/vendor/order');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->save();

        return redirect(route('master-vendor-order.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = VendorsOrderHistory::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

    // ADDITIONAL FUNCTIONS
    public function deleteFile($id)
    {
        try
        {
            $rec = VendorsOrderHistory::find($id);
            $rec->file_attachement = NULL;
            $rec->save();

            return redirect(route('master-vendor-order.edit',['id'=>$id]))->with('success-update','Your file has been removed!');
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }
}
