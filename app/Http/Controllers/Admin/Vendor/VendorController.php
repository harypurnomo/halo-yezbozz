<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Vendors;
use Validator;
use Auth;
use Str;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-vendor';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.vendor.index')->with('recVendors',Vendors::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.vendor.create');
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        // exit();

        $rules=[
            'slug'=>'required',
            'name'=>'required|min:3|max:100',
            'is_category'=>'required',
            'is_location'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-vendor.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Vendors;
        $rec->slug = trim($request->input('slug'));
        $rec->name = trim($request->input('name'));
        $rec->email = trim($request->input('email'));
        $rec->phone = trim($request->input('phone'));
        $rec->address = trim($request->input('address'));
        $rec->coordinate = trim($request->input('coordinate'));
        $rec->is_category = trim($request->input('is_category'));
        $rec->is_location = trim($request->input('is_location'));
        $rec->external_link = trim($request->input('external_link'));
        $rec->created_by = $request->input('created_by');

        //Banner
        if( $request->has('banner') ) {
            $file = $request->file('banner');
            $fileName = time().Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/vendor/banner');
            $file->move($destinationPath,$fileName);
            $rec->banner = $fileName;
        }

        //Thumbnail
        if( $request->has('thumb') ) {
            $file = $request->file('thumb');
            $fileName = time().Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/vendor/thumb');
            $file->move($destinationPath,$fileName);
            $rec->thumb = $fileName;
        }

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/vendor/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->description = trim($request->input('description'));
        $rec->seo_title = trim($request->input('seo_title'));
        $rec->seo_keyword = trim($request->input('seo_keyword'));
        $rec->seo_description = trim($request->input('seo_description'));
        $rec->is_active = $request->input('is_active');

        $rec->save();

        return redirect(route('master-vendor.index'))->with('success-update','Your work has been saved!');
    }
}
