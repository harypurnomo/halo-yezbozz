<?php

namespace App\Http\Controllers\Admin\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Seo;
use Validator;
use Auth;
use Str;

class SeoController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-seo';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.seo.index')->with('recSeo',Seo::all());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'site_name_en'=>'required',
            'site_name_id'=>'required',
            'meta_title_en'=>'required',
            'meta_title_id'=>'required',
            'meta_description_en'=>'required',
            'meta_description_id'=>'required',
            'meta_keyword_en'=>'required',
            'meta_keyword_id'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-seo.index'))->withErrors($validation)->withInput();
        }
    
        $rec = Seo::find($id);
        $rec->site_name_en = trim($request->input('site_name_en'));
        $rec->site_name_id = trim($request->input('site_name_id'));
        $rec->meta_title_en = trim($request->input('meta_title_en'));
        $rec->meta_title_id = trim($request->input('meta_title_id'));
        $rec->meta_description_en = trim($request->input('meta_description_en'));
        $rec->meta_description_id = trim($request->input('meta_description_id'));
        $rec->meta_keyword_en = trim($request->input('meta_keyword_en'));
        $rec->meta_keyword_id = trim($request->input('meta_keyword_id'));
        
        $rec->save();

        return redirect(route('master-seo.index'))->with('success-update','Your work has been saved!');
    }

}
