<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Transactions;
use Validator;
use Auth;
use Str;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-transaction';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.transaction.index')
        ->with('recTransactions',Transactions::all())
        ->with('recTotalTransactions',Transactions::all()->count())
        ->with('recCompleteTransactions',Transactions::where('is_complete',1)->count())
        ->with('recNotYetTransactions',Transactions::where('is_complete',0)->count());
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

        return view('admin.transaction.edit')
        ->with('recTransactionsByID',Transactions::find($id));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());

        $rules=[
            'no_invoice'=>'required',
            'coordinate'=>'required',
            'is_complete'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-transaction.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        Transactions::where('no_invoice',$request->input('no_invoice'))
        ->update([
                    'coordinate' => trim($request->input('coordinate')),
                    'is_complete' => $request->input('is_complete')
                ]);

        return redirect(route('master-transaction.index'))->with('success-update','Your work has been saved!');
    }

}
