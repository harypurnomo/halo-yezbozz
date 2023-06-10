<?php

namespace App\Http\Controllers\Admin\TrendPoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Transactions;
use Validator;
use Auth;
use Str;

class TrendPointController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/trend-point';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.trendpoint.index')
        ->with('recTransactionComplete',Transactions::getDataComplete())
        ->with('recTotalTransactions',Transactions::all()->count())
        ->with('recCompleteTransactions',Transactions::where('is_complete',1)->count())
        ->with('recNotYetTransactions',Transactions::where('is_complete',0)->count());
    }

}
