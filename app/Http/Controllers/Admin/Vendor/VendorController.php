<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\Vendors;
use Validator;
use Auth;
use Str;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/master-vendor';
    }

    public function index()
    {        
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.vendor.index')->with('recVendors',Vendors::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.vendor.create');
    }
}
