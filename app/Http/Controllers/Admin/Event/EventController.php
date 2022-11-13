<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Events;
use App\EventsCategory;
use Validator;
use Auth;
use Str;

class EventController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-event';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.event.index')->with('recEvents',Events::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.event.create')->with('recEventsCategory',EventsCategory::where('is_active',1)->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());
        $rules=[
            'slug'=>'required',
            'event_title_en'=>'required|min:5|max:100',
            'event_title_id'=>'required|min:5|max:100',
            'event_brief_en'=>'required',
            'event_brief_id'=>'required',
            'event_category_id'=>'required',
            'is_active'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-event.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Events;
        $rec->slug = trim($request->input('slug'));
        $rec->event_title_en = trim($request->input('event_title_en'));
        $rec->event_title_id = trim($request->input('event_title_id'));
        $rec->event_brief_en = trim($request->input('event_brief_en'));
        $rec->event_brief_id = trim($request->input('event_brief_id'));
        $rec->event_desc_en = trim($request->input('event_desc_en'));
        $rec->event_desc_id = trim($request->input('event_desc_id'));
        $rec->created_by = $request->input('created_by');
        
        //Banner
        if( $request->has('banner') ) {
            $file = $request->file('banner');
            $fileName = time().Str::slug($request->input('event_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/event/banner');
            $file->move($destinationPath,$fileName);
            $rec->banner = $fileName;
        }

        //Thumbnail
        if( $request->has('thumb') ) {
            $file = $request->file('thumb');
            $fileName = time().Str::slug($request->input('event_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/event/thumb');
            $file->move($destinationPath,$fileName);
            $rec->thumb = $fileName;
        }

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('event_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/event/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->event_category_id = $request->input('event_category_id');
        $rec->is_active = $request->input('is_active');
        $rec->is_hot = $request->input('is_hot');

        $rec->save();

        return redirect(route('master-event.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.event.edit')->with('recEventByID',Events::find($id))->with('recEventsCategory',EventsCategory::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'slug'=>'required',
            'event_title_en'=>'required|min:5|max:100',
            'event_title_id'=>'required|min:5|max:100',
            'event_brief_en'=>'required',
            'event_brief_id'=>'required',
            'event_category_id'=>'required',
            'is_active'=>'required',
            'is_hot'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-event.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Events::find($id);
        $rec->slug = trim($request->input('slug'));
        $rec->event_title_en = trim($request->input('event_title_en'));
        $rec->event_title_id = trim($request->input('event_title_id'));
        $rec->event_brief_en = trim($request->input('event_brief_en'));
        $rec->event_brief_id = trim($request->input('event_brief_id'));
        $rec->event_desc_en = trim($request->input('event_desc_en'));
        $rec->event_desc_id = trim($request->input('event_desc_id'));
        $rec->updated_by = $request->input('updated_by');
        
        //Banner
        if( $request->has('banner') ) {
            $file = $request->file('banner');
            $fileName = time().Str::slug($request->input('event_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/event/banner');
            $file->move($destinationPath,$fileName);
            $rec->banner = $fileName;
        }

        //Thumbnail
        if( $request->has('thumb') ) {
            $file = $request->file('thumb');
            $fileName = time().Str::slug($request->input('event_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/event/thumb');
            $file->move($destinationPath,$fileName);
            $rec->thumb = $fileName;
        }

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('event_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/event/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->event_category_id = $request->input('event_category_id');
        $rec->is_active = $request->input('is_active');
        $rec->is_hot = $request->input('is_hot');

        $rec->save();

        return redirect(route('master-event.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Events::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

    // ADDITIONAL FUNCTIONS
    public function deleteFile($id)
    {
        try
        {
            $rec = Events::find($id);
            $rec->file_attachement = NULL;
            $rec->save();

            return redirect(route('master-event.edit',['id'=>$id]))->with('success-update','Your file has been removed!');
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
