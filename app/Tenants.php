<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tenants extends Model
{
    protected $table = 'tenants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tenant_type_id', 'name', 'address', 'google_maps', 'coordinate',
        'phone', 'whatsapp', 'type', 'email', 'description', 'picture', 'is_active', 'is_remove', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('tenants As a')
                    ->leftjoin('tenant_type As b','a.tenant_type_id','=','b.id')
                    ->orderBy('a.updated_at','desc')
                    ->where('a.is_remove',0)
                    ->select('a.*','b.name As type_name');

        return $strQuery;
    } 

    public static function getAllByMe($userid){
        $strQuery = DB::table('tenants As a')
                    ->leftjoin('tenant_type As b','a.tenant_type_id','=','b.id')
                    ->leftjoin('tenant_representative As c','a.id','=','c.tenant_id')
                    ->where('c.user_id',$userid)
                    ->where('c.is_active',1)
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name As type_name');

        return $strQuery;
    } 

    public static function getIsActive(){
        $strQuery = DB::table('tenants As a')
                    ->leftjoin('tenant_type As b','a.tenant_type_id','=','b.id')
                    ->orderBy('a.updated_at','desc')
                    ->where('a.is_active',1)
                    ->select('a.*','b.name As type_name');

        return $strQuery;
    } 

}
