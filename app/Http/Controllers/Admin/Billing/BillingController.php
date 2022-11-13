<?php

namespace App\Http\Controllers\Admin\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Tenants;
use App\Billings;
use App\BillingStatus;
use Validator;
use Auth;
use Str;

class BillingController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-billing';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.billing.index')->with('recBillings',Billings::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.billing.create')
        ->with('recTenants',Tenants::where('is_active',1)->get())
        ->with('recBillingStatus',BillingStatus::where('is_active',1)->get());
    }

    public function store(Request $request)
    {   

        // dd($request->all());

        // explode invoice until payment due date
        $invoice_range = explode(" - ", $request->invoice_range);

        // convert string to double
        $total = str_replace(".", "", $request['total']);

        $rules=[
            'billing_number'=>'required|min:3|max:50',
            'tenant_id'=>'required',
            'total'=>'required',
            'billing_status_id'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-billing.create'))->withErrors($validation)->withInput();
        }
    
        $rec = new Billings;
        $rec->billing_number = trim($request->input('billing_number')); 
        $rec->tenant_id = $request->input('tenant_id'); 
        $rec->start_date = date('Y/m/d',strtotime($invoice_range[0])); 
        $rec->due_date = date('Y/m/d',strtotime($invoice_range[1])); 
        $rec->total = doubleval(str_replace(",",".",$total));
        $rec->desc = trim($request->input('desc')); 
        $rec->billing_status_id = $request->input('billing_status_id');
        
        //Upload Invoice
        if( $request->has('upload_invoice') ) {
            $file = $request->file('upload_invoice');
            $fileName = 'invoice_'.time().Str::slug($request->input('billing_number')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/billings');
            $file->move($destinationPath,$fileName);
            $rec->upload_invoice = $fileName;
        }

        $rec->save();

        return redirect(route('master-billing.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.billing.edit')
        ->with('recBillingsByID',Billings::find($id))
        ->with('recTenants',Tenants::where('is_active',1)->get())
        ->with('recBillingStatus',BillingStatus::where('is_active',1)->get());
    }

    public function update($id, Request $request)
    {
        // dd($request->all());

        // explode invoice until payment due date
        $invoice_range = explode(" - ", $request->invoice_range);

        // convert string to double
        $total = str_replace(".", "", $request['total']);

        $rules=[
            'billing_number'=>'required|min:3|max:50',
            'tenant_id'=>'required',
            'total'=>'required',
            'billing_status_id'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-billing.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $rec = Billings::find($id);
        $rec->billing_number = trim($request->input('billing_number')); 
        $rec->tenant_id = $request->input('tenant_id'); 
        $rec->start_date = date('Y/m/d',strtotime($invoice_range[0])); 
        $rec->due_date = date('Y/m/d',strtotime($invoice_range[1])); 
        $rec->total = doubleval(str_replace(",",".",$total));
        $rec->desc = trim($request->input('desc')); 
        $rec->billing_status_id = $request->input('billing_status_id');
        
        //Upload Invoice
        if( $request->has('upload_invoice') ) {
            $file = $request->file('upload_invoice');
            $fileName = 'invoice_'.time().Str::slug($request->input('billing_number')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/billings');
            $file->move($destinationPath,$fileName);
            $rec->upload_invoice = $fileName;
        }

        //Upload Receipt
        if( $request->has('upload_receipt') ) {
            $file = $request->file('upload_receipt');
            $fileName = 'receipt_'.time().Str::slug($request->input('billing_number')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/billings');
            $file->move($destinationPath,$fileName);
            $rec->upload_receipt = $fileName;
        }

        $rec->save();

        return redirect(route('master-billing.index'))->with('success-update','Your work has been saved!');
    }

    public function destroy($id)
    {
        // Validate Access
        Library::validateAccess('delete',$this->moduleLink);

        try
        {
            $rec = Billings::find($id);
            $rec->delete();

            return response()->json(['status'=>1,'msg'=>'Your work has been saved!'], 200);
        } 
        catch (\Exection $e) 
        {
            return response()->json(['status'=>0,'error'=>$e->getMessage()], 200);
        }
    }

}
