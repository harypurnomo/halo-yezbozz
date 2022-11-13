<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Products extends Model
{
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'product_category_id', 'product_title_en', 'product_title_id', 'product_brief_en', 'product_brief_id', 'product_desc_en', 'product_desc_id', 'slug', 'banner', 'thumb', 'file_attachement', 'price', 'tax', 'external_link', 'is_active', 'is_hot', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('products As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->join('products_category As c','a.product_category_id','=','c.id')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as user_name','c.name as category_name');

        return $strQuery;
    }

    public static function getAllIsActive(){
        $strQuery = DB::table('products As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->join('products_category As c','a.product_category_id','=','c.id')
                    ->where('a.is_active',1)
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as user_name','c.name as category_name');

        return $strQuery;
    }

    // public static function getAllIsActiveHot(){
    //     $strQuery = DB::table('products As a')
    //                 ->join('users As b','a.created_by','=','b.id')
    //                 ->where('a.is_active',1)
    //                 ->where('a.is_hot',1)
    //                 ->orderBy('a.updated_at','desc')
    //                 ->select('a.*','b.name as user_name');

    //     return $strQuery;
    // }

    // public static function getAllIsActiveLatest(){
    //     $strQuery = DB::table('products As a')
    //                 ->join('users As b','a.created_by','=','b.id')
    //                 ->where('a.is_active',1)
    //                 ->orderBy('a.updated_at','desc')
    //                 ->limit(5)
    //                 ->select('a.*','b.name as user_name');

    //     return $strQuery;
    // }

    // public static function getBySlug($slug){
    //     $strQuery = DB::table('products As a')
    //                 ->join('users As b','a.created_by','=','b.id')
    //                 ->join('products_category As c','a.products_category_id','=','c.id')
    //                 ->where('a.slug',$slug)
    //                 ->select('a.*','b.name as user_name','c.name as category_name');

    //     return $strQuery;
    // }

    // public static function getAboutUs(){
    //     $strQuery = DB::table('products As a')
    //                 ->join('users As b','a.created_by','=','b.id')
    //                 ->where('a.is_active',1)
    //                 ->where('a.products_category_id',3)
    //                 ->select('a.*','b.name as user_name');

    //     return $strQuery;
    // }

    // public static function getFacilities(){
    //     $strQuery = DB::table('products As a')
    //                 ->join('users As b','a.created_by','=','b.id')
    //                 ->where('a.is_active',1)
    //                 ->where('a.product_category_id',4)
    //                 ->select('a.*','b.name as user_name');

    //     return $strQuery;
    // }
}