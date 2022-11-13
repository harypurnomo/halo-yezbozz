<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class TenantsRepresentativeDetail extends Model
{
    protected $table = 'tenant_representative_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tenant_id', 'user_id', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    public static function getAll($params=[]){

        $strQuery = DB::table('tenant_representative_detail As a')
                    ->join('users As b','a.user_id','=','b.id')
                    ->join('tenants As c','a.tenant_id','=','c.id')
                    ->orderBy('a.updated_at','desc')
                    ->where($params)
                    ->select('a.*','b.name AS user_name','c.name AS tenant_name');

        return $strQuery;
    } 
}
