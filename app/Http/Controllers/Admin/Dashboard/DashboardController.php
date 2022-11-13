<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
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
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.dashboard.index');
    }

}
