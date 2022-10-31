<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Testimonials;
use Validator;
use Auth;
use Str;

class TestimonialController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-testimonial';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.testimonial.index')
        ->with('recTestimonials',Testimonials::orderBy('updated_at','desc')->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.testimonial.create');
    }

    public function store(Request $request)
    {    	
        // dd($request->all());
        $rules=[
            'full_name'=>'required|min:5|max:100',
            'company_name'=>'required|min:5|max:100',
            'testimonial'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-testimonial.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Testimonials;
        $rec->full_name = trim($request->input('full_name'));
        $rec->company_name = trim($request->input('company_name'));
        $rec->testimonial = trim($request->input('testimonial'));
        $rec->star = $request->input('star');
        $rec->is_active = $request->input('is_active');

        //Picture
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = Str::slug($request->input('full_name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/testimonial');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-testimonial.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
    	// Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.testimonial.edit')->with('recTestimonialsByID',Testimonials::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'full_name'=>'required|min:5|max:100',
            'company_name'=>'required|min:5|max:100',
            'testimonial'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-testimonial.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Testimonials::find($id);
        $rec->full_name = trim($request->input('full_name'));
        $rec->company_name = trim($request->input('company_name'));
        $rec->testimonial = trim($request->input('testimonial'));
        $rec->star = $request->input('star');
        $rec->is_active = $request->input('is_active');

        //Picture
        if( $request->has('picture') ) {
            $file = $request->file('picture');
            $fileName = Str::slug($request->input('full_name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/testimonial');
            $file->move($destinationPath,$fileName);
            $rec->picture = $fileName;
        }

        $rec->save();

        return redirect(route('master-testimonial.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Testimonials::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
