<?php

namespace App\Http\Controllers\Admin\CustomerTracking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Tenants;
use Validator;
use Auth;
use Str;

class CustomerTrackingController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/trend-point';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.customertracking.index')
        ->with('recTenantsActive',Tenants::getIsActive()->get())
        ->with('recTenantsTransactions',Tenants::all()->count());
    }

}
