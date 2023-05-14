<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Products;
use App\Vendors;
use App\VendorProductsPrice;
use Validator;
use Auth;
use Str;

class VendorProductPriceController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-vendor-product-price';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.vendor.price.index')->with('recVendorProductsPrice',VendorProductsPrice::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.vendor.price.create')
        ->with('recProducts',Products::getAllIsActive()->get())
        ->with('recVendor',Vendors::getAllIsActive()->get());
    }

    public function store(Request $request)
    {       
        //  dd($request->all());
        // exit();

        // convert string to double
        $qty = $request['qty'];
        $price = str_replace(".", "", $request['price']);
        $tax = str_replace(".", "", $request['tax']);

        $rules=[
            'note'=>'required|min:3|max:100',
            'product_id'=>'required',
            'vendor_id'=>'required',
            'qty'=>'required',
            'price'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-vendor-product-price.create'))->withErrors($validation)->withInput();
        }
    
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
    
            $rec = new VendorProductsPrice;
            $rec->product_id = $request->input('product_id');
            $rec->vendor_id = $request->input('vendor_id');
            $rec->note =  trim($request->input('note'));
            $rec->external_link =  trim($request->input('external_link'));
            $rec->qty = $qty;
            $rec->price = doubleval(str_replace(",",".",$price));
            $rec->tax = doubleval(str_replace(",",".",$tax));
            $rec->final_price = $final_price; //$doubleval(str_replace(",",".",$final_price));
            $rec->recommended = $request->input('recommended');
            $rec->created_by = $request->input('created_by');
            $rec->save();
        }

        $rec->save();

        return redirect(route('master-vendor-product-price.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.vendor.price.edit')
        ->with('recProducts',Products::getAllIsActive()->get())
        ->with('recVendor',Vendors::getAllIsActive()->get())
        ->with('recVendorProductsPriceByID',VendorProductsPrice::find($id));
    }

    public function update($id, Request $request)
    {
        // convert string to double
        $qty = $request['qty'];
        $price = str_replace(".", "", $request['price']);
        $tax = str_replace(".", "", $request['tax']);

        $rules=[
            'note'=>'required|min:3|max:100',
            'product_id'=>'required',
            'vendor_id'=>'required',
            'qty'=>'required',
            'price'=>'required'
        ];


        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-vendor-product-price.create'))->withErrors($validation)->withInput();
        }
    
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
    
            $rec = VendorProductsPrice::find($id);
            $rec->product_id = $request->input('product_id');
            $rec->vendor_id = $request->input('vendor_id');
            $rec->note =  trim($request->input('note'));
            $rec->external_link =  trim($request->input('external_link'));
            $rec->qty = $qty;
            $rec->price = doubleval(str_replace(",",".",$price));
            $rec->tax = doubleval(str_replace(",",".",$tax));
            $rec->final_price = $final_price; //$doubleval(str_replace(",",".",$final_price));
            $rec->recommended = $request->input('recommended');
            $rec->updated_by = $request->input('updated_by');
            $rec->save();
        }

        return redirect(route('master-vendor-product-price.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = VendorProductsPrice::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
