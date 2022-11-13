<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Teams;
use Validator;
use Image;
use Auth;
use Str;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-team';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.team.index')->with('recTeams',Teams::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.team.create');
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:100',
            'title'=>'required|min:5|max:100',
            'sort'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-team.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Teams;
        $rec->name = trim($request->input('name'));
        $rec->title = trim($request->input('title'));
        $rec->sort = $request->input('sort');
        $rec->is_active = $request->input('is_active');
        
        //Team
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/team');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-team.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.team.edit')->with('recTeamByID',Teams::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'name'=>'required|min:5|max:100',
            'title'=>'required|min:5|max:100',
            'sort'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-team.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Teams::find($id);
        $rec->name = trim($request->input('name'));
        $rec->title = trim($request->input('title'));
        $rec->sort = $request->input('sort');
        $rec->is_active = $request->input('is_active');
        
        //Team
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = time().Str::slug($request->input('title')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/team');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-team.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Teams::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
