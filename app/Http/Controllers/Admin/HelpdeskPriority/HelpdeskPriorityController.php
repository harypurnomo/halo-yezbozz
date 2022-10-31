<?php

namespace App\Http\Controllers\Admin\HelpdeskPriority;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\HelpdeskPriority;
use Validator;
use Auth;
use Str;

class HelpdeskPriorityController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-priority-of-helpdesk';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.helpdeskpriority.index')
        ->with('recHelpdeskPriority',HelpdeskPriority::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.helpdeskpriority.create');
    }

    public function store(Request $request)
    {    	
        // dd($request->all());
        $rules=[
            'name'=>'required|min:3'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-priority-of-helpdesk.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new HelpdeskPriority;
        $rec->name = trim($request->input('name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-priority-of-helpdesk.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
    	// Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.helpdeskpriority.edit')->with('recHelpdeskPriorityByID',HelpdeskPriority::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'name'=>'required|min:3'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-priority-of-helpdesk.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = HelpdeskPriority::find($id);
        $rec->name = trim($request->input('name'));
        $rec->is_active = $request->input('is_active');
        $rec->save();

        return redirect(route('master-priority-of-helpdesk.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = HelpdeskPriority::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
