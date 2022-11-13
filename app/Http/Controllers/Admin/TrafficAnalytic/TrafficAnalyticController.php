<?php

namespace App\Http\Controllers\Admin\TrafficAnalytic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use App\Library\Library;
use Validator;
use Auth;
use Str;
use Analytics;

class TrafficAnalyticController extends Controller
{
    public function __construct()
    {
        $this->moduleLink = 'administrator/traffic-analytics';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        //User Types
        $fetchUserTypes = Analytics::fetchUserTypes(Period::days(30));

        $fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

        $fetchTopReferrers = Analytics::fetchTopReferrers(Period::days(7));

        // dd($fetchTopReferrers);

        return view('admin.trafficanalytic.index')
        ->with('fetchUserTypes',$fetchUserTypes)
        ->with('fetchTotalVisitorsAndPageViews',$fetchTotalVisitorsAndPageViews)
        ->with('fetchTopReferrers',$fetchTopReferrers);
    }

}
