<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\TenantsType;
use App\Tenants;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use App\Library\Library;
use Validator;
use Auth;
use Str;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/dashboard';
    }

    public function index()
    {
        return view('admin.dashboard.index')
        ->with('recTenantsType',TenantsType::where('is_remove',0)->orderBy('updated_at','desc')->get());
    }

    public function show($tenant_type_id)
    {        
        return view('admin.dashboard.tenant')
        ->with('recTenants',Tenants::getAllByTenantTypeID($tenant_type_id)->get());
    }
}
