<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Pages;
use Validator;
use Auth;
use Str;

class PageController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-page';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.page.index')->with('recPages',Pages::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.page.create');
    }

    public function store(Request $request)
    {    	
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:100',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'meta_keyword'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-page.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Pages;
        $rec->name = trim($request->input('name'));
        $rec->meta_title = trim($request->input('meta_title'));
        $rec->meta_description = trim($request->input('meta_description'));
        $rec->meta_keyword = trim($request->input('meta_keyword'));
        $rec->save();

        return redirect(route('master-page.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
    	// Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.page.edit')->with('recPagesByID',Pages::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:100',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'meta_keyword'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-page.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

    
        $rec = Pages::find($id);
        $rec->name = trim($request->input('name'));
        $rec->meta_title = trim($request->input('meta_title'));
        $rec->meta_description = trim($request->input('meta_description'));
        $rec->meta_keyword = trim($request->input('meta_keyword'));
        $rec->save();

        return redirect(route('master-page.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Pages::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
