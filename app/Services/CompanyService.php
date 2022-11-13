<?php
namespace App\Services;

use App\Company;

class CompanyService
{
	public function getCompanyByUserID($user_id){
		
		$strQuery = Company::where('user_id',$user_id)->get();
		return $strQuery;
	}
}