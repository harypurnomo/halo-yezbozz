<?php
namespace App\Library;

use Auth;
use Str;
use DB;
use App\GroupModule;
use App\Seo;
use App\CompanyProfile;
use App\Modules;
use App\GoogleAnalytics;
use App\Tenants;

class Library 
{
	public static function validateAccess($mode='', $url)
	{
		$groupId = Auth::user()->group_id;
		$checkValid = GroupModule::getJoinRow(['a.group_id'=>$groupId,'link'=>$url,'acl_'.$mode=>'1'])->first();

		if(!$checkValid) {
			if(\Request::ajax()) {
				return response()->json(array('status'=>'0','error'=>'You are not authorized to access this page!'));
				exit();
			}

			// echo "You are not authorized to access this page!";
			echo view('admin.error.template-error1')->with('error','You are not authorized to access this page!')->with('url',$url);
			exit();
		}
	}

	public static function userMenu()
	{
		$groupId = Auth::user()->group_id;
		$module = GroupModule::getJoinRow(['category'=>1,'acl_view'=>1,'a.group_id'=>$groupId])->get();
        foreach ($module as $key => $value) {
            $child=GroupModule::getJoinRow(['parent_id'=>$value->module_id,'acl_view'=>1,'a.group_id'=>$groupId])->get();
            $module[$key]->child_module = $child;
		}
		return view('admin.layouts.main-menu')->with('module',$module);
	}

	public static function check($groupId,$modId,$field)
	{
		$checkValid = GroupModule::where(['group_id'=>$groupId,'module_id'=>$modId,$field=>'1'])->first();
		if($checkValid) return 'checked';
	}

	public static function seo(){
		$strQuery = Seo::all();
		return $strQuery;
	}

	public static function companyProfile(){
		$strQuery = CompanyProfile::all();
		return $strQuery;
	}

	public static function modules($link){
		$strQuery = Modules::where('link',$link)->get();
		return $strQuery;
	}

	public static function googleAnalytics(){
		$strQuery = GoogleAnalytics::first();
		return $strQuery;
	}

	public static function TenantsTotalByType($tenantId){
		$strQuery = Tenants::where('tenant_type_id',$tenantId)->get();
		return $strQuery;
	}

}