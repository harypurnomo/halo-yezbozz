<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Groups;
use App\Modules;
use App\GroupModule;
use Validator;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-group';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.group.index')->with('group',Groups::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        $module = Modules::getJoinRow(['a.category'=>1])->get();
        foreach ($module as $key => $value) {
            $child=Modules::getJoinRow(['a.parent_id'=>$value->module_id])->get();
            $module[$key]->child_module = $child;
        }
        return view('admin.group.create')->with('module',$module);
    }

    public function store(Request $request)
    {
        $rules=[
            'group_name'=>'required|min:5|max:50',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          $error = '';
          foreach ($validation->errors()->all('<li>:message</li>') as $item) {
            $error .= $item;
          }
          return response()->json(['status'=>0,'error'=>$error], 200);
        }

        if(!$request->has('access')) return response()->json(['status'=>0,'error'=>'Group access must be filled!'], 200);

        $group = new Groups;
        $group->group_name = trim($request->input('group_name'));
        $group->is_active = $request->input('is_active');
        $group->save();
        $id = $group->group_id;

        //delete group access
        GroupModule::where('group_id',$id)->delete();

        //insert group access
        $access = $request->input('access');
        if(count($access) > 0) {
            $a=1;
            $data = [];
            foreach ($access as $key) 
            {
                $array_id = explode("_", $key);
                $module_id = $array_id[0];
                $module_desc = $array_id[1];
                if($a==1) 
                {
                    $last_mod = $module_id; 
                    $data = ['group_id'=>$id,'module_id'=>$module_id];
                }

                if($module_id != $last_mod && $a != 1)
                {
                    GroupModule::insert($data);   
                    $data = ['group_id'=>$id,'module_id'=>$module_id,'acl_'.$module_desc=>'1'];
                }
                else 
                {
                    $data = array_merge($data, ['acl_'.$module_desc=>'1']);
                }

                if($a == count($access)) GroupModule::insert($data);  
                
                $last_mod = $module_id;
                $a++;
            }
        }

        return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        if(!Groups::find($id)) return redirect('administrator/master-group')->with('error','Group ID not found!');
        $module = Modules::getJoinRow(['a.category'=>1])->get();
        foreach ($module as $key => $value) {
            $child=Modules::getJoinRow(['a.parent_id'=>$value->module_id])->get();
            $module[$key]->child_module = $child;
        }

        return view('admin.group.edit')->with('row',Groups::find($id))->with('module',$module);
    }

    public function update($id, Request $request)
    {
        $rules=[
            'group_name'=>'required|min:3',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          $error = '';
          foreach ($validation->errors()->all('<li>:message</li>') as $item) {
            $error .= $item;
          }
          return response()->json(['status'=>0,'error'=>$error], 200);
        }

        if(!$request->has('access')) return response()->json(['status'=>0,'error'=>'Group access must be filled!'], 200);

        $group = Groups::find($id);
        $group->group_name = trim($request->input('group_name'));
        $group->is_active = $request->input('is_active');
        $group->save();

        //delete group access
        GroupModule::where('group_id',$id)->delete();
        //insert group access
        $access = $request->input('access');
        if(count($access) > 0) {
            $a=1;
            $data = [];
            foreach ($access as $key) 
            {
                $array_id = explode("_", $key);
                $module_id = $array_id[0];
                $module_desc = $array_id[1];
                if($a==1) 
                {
                    $last_mod = $module_id; 
                    $data = ['group_id'=>$id,'module_id'=>$module_id];
                }

                if($module_id != $last_mod && $a != 1)
                {
                    GroupModule::insert($data);   
                    $data = ['group_id'=>$id,'module_id'=>$module_id,'acl_'.$module_desc=>'1'];
                }
                else 
                {
                    $data = array_merge($data, ['acl_'.$module_desc=>'1']);
                }

                if($a == count($access)) GroupModule::insert($data);  
                
                $last_mod = $module_id;
                $a++;
            }
        }

        return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
    }

}
