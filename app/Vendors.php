<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Vendors extends Model
{
    protected $table = 'vendors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'phone', 'address', 
        'coordinate', 'description', 'slug', 'banner', 'thumb', 'file_attachement', 'seo_title', 'seo_keyword', 'seo_description',
        'external_link', 'is_category', 'is_active', 'is_location', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('vendors As a')
                    ->orderBy('a.name','asc')
                    ->select('a.*');

        return $strQuery;
    }

    public static function getAllIsActive(){
        $strQuery = DB::table('vendors As a')
                    ->where('a.is_active',1)
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*');

        return $strQuery;
    }

   
}