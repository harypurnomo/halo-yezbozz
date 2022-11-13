<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Market;
use App\MarketCategory;
use Validator;
use Auth;
use Str;

class MarketController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-market';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.market.index')->with('recMarket',Market::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.market.create')->with('recMarketCategory',MarketCategory::where('is_active',1)->get());
    }

    public function store(Request $request)
    {       
        // dd($request->all());

        $rules=[
            'slug'=>'required',
            'company_name'=>'required|min:5|max:100',
            'email'=>'required|min:5|max:100',
            'phone'=>'required|min:8|max:30',
            'address'=>'required',
            'market_brief_en'=>'required|max:150',
            'market_brief_id'=>'required|max:150',
            'market_category_id'=>'required',
            'is_active'=>'required',
            'is_hot'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-market.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Market;
        $rec->slug = trim($request->input('slug'));
        $rec->company_name = trim($request->input('company_name'));
        $rec->email = trim($request->input('email'));
        $rec->phone = $request->input('phone');
        $rec->address = trim($request->input('address'));
        $rec->market_brief_en = trim($request->input('market_brief_en'));
        $rec->market_brief_id = trim($request->input('market_brief_id'));
        $rec->market_desc_en = trim($request->input('market_desc_en'));
        $rec->market_desc_id = trim($request->input('market_desc_id'));
        $rec->created_by = $request->input('created_by');
        
        //Banner
        if( $request->has('banner') ) {
            $file = $request->file('banner');
            $fileName = time().Str::slug($request->input('market_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/market/banner');
            $file->move($destinationPath,$fileName);
            $rec->banner = $fileName;
        }

        //Thumbnail
        if( $request->has('thumb') ) {
            $file = $request->file('thumb');
            $fileName = time().Str::slug($request->input('market_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/market/thumb');
            $file->move($destinationPath,$fileName);
            $rec->thumb = $fileName;
        }

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('market_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/market/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->market_category_id = $request->input('market_category_id');
        $rec->is_active = $request->input('is_active');
        $rec->is_hot = $request->input('is_hot');

        $rec->save();

        return redirect(route('master-market.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.market.edit')
        ->with('recMarketByID',Market::find($id))
        ->with('recMarketCategory',MarketCategory::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $rules=[
            'slug'=>'required',
            'company_name'=>'required|min:5|max:100',
            'email'=>'required|min:5|max:100',
            'phone'=>'required|min:8|max:30',
            'address'=>'required',
            'market_brief_en'=>'required|max:150',
            'market_brief_id'=>'required|max:150',
            'market_category_id'=>'required',
            'is_active'=>'required',
            'is_hot'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-market.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Market::find($id);
        $rec->slug = trim($request->input('slug'));
        $rec->company_name = trim($request->input('company_name'));
        $rec->email = trim($request->input('email'));
        $rec->phone = $request->input('phone');
        $rec->address = trim($request->input('address'));
        $rec->market_brief_en = trim($request->input('market_brief_en'));
        $rec->market_brief_id = trim($request->input('market_brief_id'));
        $rec->market_desc_en = trim($request->input('market_desc_en'));
        $rec->market_desc_id = trim($request->input('market_desc_id'));
        $rec->updated_by = $request->input('updated_by');
        
        //Banner
        if( $request->has('banner') ) {
            $file = $request->file('banner');
            $fileName = time().Str::slug($request->input('market_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/market/banner');
            $file->move($destinationPath,$fileName);
            $rec->banner = $fileName;
        }

        //Thumbnail
        if( $request->has('thumb') ) {
            $file = $request->file('thumb');
            $fileName = time().Str::slug($request->input('market_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/market/thumb');
            $file->move($destinationPath,$fileName);
            $rec->thumb = $fileName;
        }

        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = time().Str::slug($request->input('market_title_en')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/market/file_attachement');
            $file->move($destinationPath,$fileName);
            $rec->file_attachement = $fileName;
        }

        $rec->market_category_id = $request->input('market_category_id');
        $rec->is_active = $request->input('is_active');
        $rec->is_hot = $request->input('is_hot');

        $rec->save();

        return redirect(route('master-market.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Market::find($id);
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
            $rec = Market::find($id);
            $rec->file_attachement = NULL;
            $rec->save();

            return redirect(route('master-market.edit',['id'=>$id]))->with('success-update','Your file has been removed!');
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
