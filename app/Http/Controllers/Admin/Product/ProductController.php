<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Products;
use App\ProductsCategory;
use App\VendorProductsPrice;
use App\Vendors;
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

        return view('admin.product.create')
                ->with('recProductsCategory',ProductsCategory::where('is_active',1)->get())
                ->with('recVendors',Vendors::where('is_active',1)->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());

        // convert string to double
        $qty = $request['vendor_qty'];
        $price = str_replace(".", "", $request['vendor_price']);
        $tax = str_replace(".", "", $request['vendor_tax']);
       
        $rules=[
            'slug'=>'required',
            'product_title_id'=>'required|min:3|max:100',
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
        $rec->seo_title = trim($request->input('seo_title'));
        $rec->seo_keyword = trim($request->input('seo_keyword'));
        $rec->seo_description = trim($request->input('seo_description'));
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


        //Rumus menghitung harga dasar dan menyimpan di table vendor_products_price
        // dd($request->all());

        if(!empty($price)){
            if(!empty($tax)){
                $isTax = $tax/100;
                $isTaxInPrice = $price*$isTax;
                $isPriceAfterTax = $price + $isTaxInPrice;
                $final_price = $isPriceAfterTax/$qty;
            }
            else{
                $final_price = $price/$qty;
            }

            // dd($final_price);
    
            $recVendorProductsPrice = new VendorProductsPrice;
            $recVendorProductsPrice->product_id = $rec->id;
            $recVendorProductsPrice->vendor_id = $request->input('vendor_id');
            $recVendorProductsPrice->note =  trim($request->input('vendor_note'));
            $recVendorProductsPrice->external_link =  trim($request->input('vendor_external_link'));
            $recVendorProductsPrice->qty = $qty;
            $recVendorProductsPrice->price = doubleval(str_replace(",",".",$price));
            $recVendorProductsPrice->tax = doubleval(str_replace(",",".",$tax));
            $recVendorProductsPrice->final_price = $final_price; //$doubleval(str_replace(",",".",$final_price));
            $recVendorProductsPrice->created_by = $request->input('created_by');
            $recVendorProductsPrice->save();
        }
        
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
            'product_title_id'=>'required|min:3|max:100',
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
        $rec->seo_title = trim($request->input('seo_title'));
        $rec->seo_keyword = trim($request->input('seo_keyword'));
        $rec->seo_description = trim($request->input('seo_description'));
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

            $recVendorProductsPrice = VendorProductsPrice::where('product_id',$id);
            $recVendorProductsPrice->delete();

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
