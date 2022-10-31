<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class TenantsRepresentative extends Model
{
    protected $table = 'tenant_representative';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tenant_id', 'user_id', 'description', 'is_active', 'is_remove', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


     public static function getAll(){

        $strQuery = DB::table('tenant_representative As a')
                    ->join('users As b','a.user_id','=','b.id')
                    ->orderBy('a.updated_at','desc')
                    ->where('a.is_remove',0)
                    ->select('a.*','b.name AS user_name');

        return $strQuery;
    } 
}
