<?php

namespace App\Http\Controllers\Admin\GoogleAnalytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Library;
use App\GoogleAnalytics;
use Validator;
use Auth;
use Str;

class GoogleAnalyticsController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-google-analytics';
    }

    public function index()
    {

        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.googleanalytics.index')->with('recGoogleAnalytics',GoogleAnalytics::first());
    }

    public function update($id, Request $request)
    {

        // dd($request->all());
        $rules=[
            'analytics_view_id'=>'required|min:5|max:25',
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-google-analytics.index'))->withErrors($validation)->withInput();
        }
    
        $rec = GoogleAnalytics::find($id);
        $rec->analytics_view_id = trim($request->input('analytics_view_id'));
        
        //File Attachement
        if( $request->has('files') ) {
            $file = $request->file('files');
            $fileName = 'service-account-credentials.'.$file->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/analytics/files/');
            $file->move($destinationPath,$fileName);

            $rec->service_account_credentials_json = $fileName;
        }

        $rec->save();

        return redirect(route('master-google-analytics.index'))->with('success-update','Your work has been saved!');
    }

}
