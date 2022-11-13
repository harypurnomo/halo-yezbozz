<?php

namespace App\Http\Controllers\Admin\EventCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\EventsCategory;
use Validator;
use Auth;
use Str;

class EventCategoryController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-category-of-event';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.eventcategory.index')->with('recEventsCategory',EventsCategory::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.eventcategory.create');
    }

    public function store(Request $request)
    {    	
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:50'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-category-of-event.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new EventsCategory;
        $rec->name = trim($request->input('name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-category-of-event.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
    	// Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.eventcategory.edit')->with('recEventsCategoryByID',EventsCategory::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:50'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-category-of-event.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = EventsCategory::find($id);
        $rec->name = trim($request->input('name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-category-of-event.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = EventsCategory::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
