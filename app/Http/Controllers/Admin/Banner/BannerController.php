<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Banners;
use Validator;
use Auth;
use Str;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-banner';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.banner.index')->with('recBanners',Banners::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.banner.create');
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'title_en'=>'required|min:5',
            'title_id'=>'required|min:5',
            'brief_en'=>'required|min:5|max:140',
            'brief_id'=>'required|min:5|max:140',
            'sort'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-banner.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Banners;
        $rec->title_en = trim($request->input('title_en'));
        $rec->title_id = trim($request->input('title_id'));
        $rec->brief_en = trim($request->input('brief_en'));
        $rec->brief_id = trim($request->input('brief_id'));
        $rec->sort = $request->input('sort');
        $rec->link_en = trim($request->input('link_en'));
        $rec->link_id = trim($request->input('link_id'));
        $rec->is_active = $request->input('is_active');
        
        //Banner
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/banner');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-banner.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.banner.edit')->with('recBannerByID',Banners::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'title_en'=>'required|min:5',
            'title_id'=>'required|min:5',
            'brief_en'=>'required|min:5|max:140',
            'brief_id'=>'required|min:5|max:140',
            'sort'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-banner.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Banners::find($id);
        $rec->title_en = trim($request->input('title_en'));
        $rec->title_id = trim($request->input('title_id'));
        $rec->brief_en = trim($request->input('brief_en'));
        $rec->brief_id = trim($request->input('brief_id'));
        $rec->sort = $request->input('sort');
        $rec->link_en = trim($request->input('link_en'));
        $rec->link_id = trim($request->input('link_id'));
        $rec->is_active = $request->input('is_active');
        
        //Banner
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/banner');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-banner.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Banners::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
