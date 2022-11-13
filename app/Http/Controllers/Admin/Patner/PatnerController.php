<?php

namespace App\Http\Controllers\Admin\Patner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Patners;
use Validator;
use Auth;
use Str;

class PatnerController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-patner';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.patner.index')->with('recPatners',Patners::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.patner.create');
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
          return redirect(route('master-patner.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Patners;
        $rec->title = trim($request->input('title'));
        $rec->sort = $request->input('sort');
        $rec->is_active = $request->input('is_active');
        
        //Patner
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/patner');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-patner.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.patner.edit')->with('recPatnerByID',Patners::find($id));
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
          return redirect(route('master-patner.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Patners::find($id);
        $rec->title = trim($request->input('title'));
        $rec->sort = $request->input('sort');
        $rec->is_active = $request->input('is_active');
        
        //Patner
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/patner');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-patner.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Patners::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
