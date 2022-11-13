<?php

namespace App\Http\Controllers\Admin\Subscribe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Library\Library;
use App\Subscribe;
use Validator;
use Auth;
use Str;

class SubscribeController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-subscribe';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.subscribe.index')->with('recSubscribe',Subscribe::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.subscribe.create');
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'email'=>'required|email|unique:subscribe,email',
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-subscribe.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Subscribe;
        $rec->email = trim($request->input('email')); 
        $rec->ip = $request->ip();
        $rec->save();

        return redirect(route('master-subscribe.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.subscribe.edit')->with('recSubscribeByID',Subscribe::find($id));
    }

    public function update($id, Request $request)
    {       
        // dd($request->all());
        $rules=[
            'email' =>  [   
                            'required',
                            Rule::unique('users')->ignore($id),
                        ]
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-subscribe.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }
    
        $rec = Subscribe::find($id);
        $rec->email = trim($request->input('email')); 
        $rec->ip = $request->ip();
        $rec->save();

        return redirect(route('master-subscribe.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Subscribe::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }


}
