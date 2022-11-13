<?php

namespace App\Http\Controllers\Admin\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Modules;
use Validator;
use Auth;

class ModuleController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-module';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        $module = Modules::getJoinRow(['a.category'=>1])->get();
        foreach ($module as $key => $value) {
            $child = Modules::getJoinRow(['a.parent_id'=>$value->module_id])->get();
            $module[$key]->child_module = $child;
        }
        return view('admin.module.index')->with('module',$module);
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.module.create')->with('parent',Modules::getJoinRow(['a.category'=>1])->get());
    }

    public function store(Request $request)
    {
        $rules=[
            'module_name'=>'required|min:5|max:50',
            'tipe_menu'=>'required',
            'parent_menu'=>'required_if:tipe_menu,2',
            'link'=>'required',
            'order'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          $error = '';
          foreach ($validation->errors()->all('<li>:message</li>') as $item) {
            $error .= $item;
          }
          return response()->json(['status'=>0,'error'=>$error], 200);
        }

        $module = new Modules;
        $module->module_name = trim($request->input('module_name'));
        $module->category = trim($request->input('tipe_menu'));
        $module->parent_id = (trim($request->input('parent_menu')==''))?null:trim($request->input('parent_menu'));
        $module->link = $request->input('link');
        $module->icon = $request->input('icon');
        $module->order = $request->input('order');
        $module->created_by = Auth::user()->id;  
        $module->save();

        return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        if(!Modules::find($id)) return redirect('administrator/master-module')->with('error','Menu ID not found!');
        return view('admin.module.edit')->with('parent',Modules::getJoinRow(['a.category'=>1])->get())->with('row',Modules::find($id));
    }

    public function update($id, Request $request)
    {
        $rules=[
            'module_name'=>'required|min:5|max:50',
            'tipe_menu'=>'required',
            'parent_menu'=>'required_if:tipe_menu,2',
            'link'=>'required',
            'order'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
            $error = '';
            foreach ($validation->errors()->all('<li>:message</li>') as $item) {
                $error .= $item;
            }
            return response()->json(['status'=>0,'error'=>$error], 200);
        }

        $module = Modules::find($id);
        $module->module_name = trim($request->input('module_name'));
        $module->category = trim($request->input('tipe_menu'));
        $module->parent_id = (trim($request->input('parent_menu')==''))?null:trim($request->input('parent_menu'));
        $module->link = $request->input('link');
        $module->icon = $request->input('icon');
        $module->order = $request->input('order');
        $module->updated_by = Auth::user()->id;  
        $module->save();

        return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $module = Modules::find($id);
            $module->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }
}
