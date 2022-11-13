<?php

namespace App\Http\Controllers\Admin\Facilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Facilities;
use Validator;
use Auth;
use Str;

class FacilitiesController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-facilities';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.facilities.index')->with('recFacilities',Facilities::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'title'=>'required|min:5|max:100',
            'sort'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-facilities.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Facilities;
        $rec->title = trim($request->input('title'));
        $rec->sort = $request->input('sort');
        $rec->is_active = $request->input('is_active');
        
        //Facilities
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/facilities');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-facilities.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.facilities.edit')->with('recFacilitiesByID',Facilities::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'title'=>'required|min:5|max:100',
            'sort'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-facilities.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Facilities::find($id);
        $rec->title = trim($request->input('title'));
        $rec->sort = $request->input('sort');
        $rec->is_active = $request->input('is_active');
        
        //Facilities
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/facilities');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-facilities.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Facilities::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
