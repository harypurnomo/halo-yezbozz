<?php

namespace App\Http\Controllers\Admin\Popup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Popup;
use Validator;
use Auth;
use Str;

class PopupController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/manage-popup';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.popup.index')->with('recPopup',Popup::all());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.popup.create');
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'title'=>'required|min:3',
            'text_content'=>'required',
            'close_time'=>'required|numeric',
            'is_active'=>'required',
            'show_title'=>'required',
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('manage-popup.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Popup;
        $rec->title = trim($request->input('title'));
        $rec->text_content = trim($request->input('text_content'));
        $rec->close_time = trim($request->input('close_time'));
        $rec->created_by = $request->input('created_by');
        $rec->is_active = $request->input('is_active');
        $rec->show_title = $request->input('show_title');
        $rec->save();

        return redirect(route('manage-popup.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.popup.edit')->with('recPopupById',Popup::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'title'=>'required|min:3',
            'text_content'=>'required',
            'close_time'=>'required|numeric',
            'is_active'=>'required',
            'show_title'=>'required',
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
            return redirect(route('manage-popup.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Popup::find($id);
        $rec->title = trim($request->input('title'));
        $rec->text_content = trim($request->input('text_content'));
        $rec->close_time = trim($request->input('close_time'));
        $rec->created_by = $request->input('created_by');
        $rec->is_active = $request->input('is_active');
        $rec->show_title = $request->input('show_title');
        $rec->save();

        return redirect(route('manage-popup.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Popup::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }
}
