<?php

namespace App\Http\Controllers\Admin\CompanyProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\CompanyProfile;
use Validator;
use Auth;
use Str;

class CompanyProfileController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-company-profile';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.companyprofile.index')->with('recCompanyProfile',CompanyProfile::all());
    }

    public function update($id, Request $request)
    {
        $rules=[
            'company_name'=>'required|min:5|max:100',
            'company_brief_en'=>'required|min:5|max:250',
            'company_brief_id'=>'required|min:5|max:250',
            'address'=>'required',
            'email'=>'required',
            'phone_number'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-company-profile.index'))->withErrors($validation)->withInput();
        }
    
        $rec = CompanyProfile::find($id);
        $rec->company_name = trim($request->input('company_name'));
        
        //Logo
        if( $request->has('logo') ) {
            $file = $request->file('logo');
            $fileName = time().Str::slug($request->input('company_name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/logo');
            $file->move($destinationPath,$fileName);
            $rec->logo = $fileName;
        }

        //Favicon
        if( $request->has('favicon') ) {
            $file = $request->file('favicon');
            $fileName = time().Str::slug($request->input('company_name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/favicon');
            $file->move($destinationPath,$fileName);
            $rec->favicon = $fileName;
        }

        $rec->company_brief_en = trim($request->input('company_brief_en'));
        $rec->company_brief_id = trim($request->input('company_brief_id'));
        $rec->address = trim($request->input('address'));
        $rec->email = trim($request->input('email'));
        $rec->phone_number = trim($request->input('phone_number'));
        $rec->whatsapp_number = trim($request->input('whatsapp_number'));
        $rec->fax = trim($request->input('fax'));
        $rec->instagram = trim($request->input('instagram'));
        $rec->youtube = trim($request->input('youtube'));
        $rec->facebook = trim($request->input('facebook'));
        $rec->twitter = trim($request->input('twitter'));
        $rec->linkedin = trim($request->input('linkedin'));
        $rec->save();

        return redirect(route('master-company-profile.index'))->with('success-update','Your work has been saved!');
    }

}
