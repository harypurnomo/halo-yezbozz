<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Products;
use App\ProductsCategory;
use Validator;
use Auth;
use Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-product';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.product.index')->with('recProducts',Products::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.product.create')->with('recProductsCategory',ProductsCategory::where('is_active',1)->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());

        // convert string to double
        $price = str_replace(".", "", $request['price']);
        $tax = str_replace(".", "", $request['tax']);


        $rules=[
            'slug'=>'required',
            'product_title_en'=>'required|min:5|max:80',
            'product_title_id'=>'required|min:5|max:80',
            'product_brief_en'=>'required',
            'product_brief_id'=>'required',
            'product_category_id'=>'required',
            'is_active'=>'required',
            'is_hot'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-product.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Products;
        $rec->slug = trim($request->input('slug'));
        $rec->product_title_en = trim($request->input('product_title_en'));
        $rec->product_title_id = trim($request->input('product_title_id'));
        $rec->product_brief_en = trim($request->input('product_brief_en'));
        $rec->product_brief_id = trim($request->input('product_brief_id'));
        $rec->product_desc_en = trim($request->input('product_desc_en'));
        $rec->product_desc_id = trim($request->input('product_desc_id'));
        $rec->price = doubleval(str_replace(",",".",$price));
        $rec->tax = doubleval(str_replace(",",".",$tax));
        $rec->external_link = trim($request->input('external_link'));
        $rec->created_by = $request->input('created_by');
        
        //Banner
        if( $request->has('banner') ) {
            $file = $request->file('banner');
            $fileName = time().Str::slug($request->input('product_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/product/banner');
            $file->move($destinationPath,$fileName);
            $rec->banner = $fileName;
        }

        //Thumbnail
        if( $request->has('thumb') ) {
            $file = $request->file('thumb');
            $fileName = time().Str::slug($request->input('product_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/product/thumb');
            $file->move($destinationPath,$fileName);
            $rec->thumb = $fileName;
        }

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('product_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/product/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->product_category_id = $request->input('product_category_id');
        $rec->is_active = $request->input('is_active');
        $rec->is_hot = $request->input('is_hot');

        $rec->save();

        return redirect(route('master-product.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.product.edit')
        ->with('recProductsByID',Products::find($id))
        ->with('recProductsCategory',ProductsCategory::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());

        // convert string to double
        $price = str_replace(".", "", $request['price']);
        $tax = str_replace(".", "", $request['tax']);


        $rules=[
            'slug'=>'required',
            'product_title_en'=>'required|min:5|max:80',
            'product_title_id'=>'required|min:5|max:80',
            'product_brief_en'=>'required',
            'product_brief_id'=>'required',
            'product_category_id'=>'required',
            'is_active'=>'required',
            'is_hot'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-product.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Products::find($id);
        $rec->slug = trim($request->input('slug'));
        $rec->product_title_en = trim($request->input('product_title_en'));
        $rec->product_title_id = trim($request->input('product_title_id'));
        $rec->product_brief_en = trim($request->input('product_brief_en'));
        $rec->product_brief_id = trim($request->input('product_brief_id'));
        $rec->product_desc_en = trim($request->input('product_desc_en'));
        $rec->product_desc_id = trim($request->input('product_desc_id'));
        $rec->price = doubleval(str_replace(",",".",$price));
        $rec->tax = doubleval(str_replace(",",".",$tax));
        $rec->external_link = trim($request->input('external_link'));
        $rec->updated_by = $request->input('updated_by');
        
        //Banner
        if( $request->has('banner') ) {
            $file = $request->file('banner');
            $fileName = time().Str::slug($request->input('product_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/product/banner');
            $file->move($destinationPath,$fileName);
            $rec->banner = $fileName;
        }

        //Thumbnail
        if( $request->has('thumb') ) {
            $file = $request->file('thumb');
            $fileName = time().Str::slug($request->input('product_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/product/thumb');
            $file->move($destinationPath,$fileName);
            $rec->thumb = $fileName;
        }

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('product_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/product/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->product_category_id = $request->input('product_category_id');
        $rec->is_active = $request->input('is_active');
        $rec->is_hot = $request->input('is_hot');

        $rec->save();

        return redirect(route('master-product.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Products::find($id);
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
            $rec = Products::find($id);
            $rec->file_attachement = NULL;
            $rec->save();

            return redirect(route('master-product.edit',['id'=>$id]))->with('success-update','Your file has been removed!');
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
