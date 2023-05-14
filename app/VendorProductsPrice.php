<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class VendorProductsPrice extends Model
{
    protected $table = 'vendor_products_price';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'product_id', 'vendor_id', 'note', 'external_link', 
        'qty', 'price', 'tax', 'final_price', 'recommended',
        'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('vendor_products_price As a')
                    ->join('products As b','a.product_id','=','b.id')
                    ->join('vendors As c','a.vendor_id','=','c.id')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.product_title_id','c.name as vendor_name');

        return $strQuery;
    }

    // public static function getAllIsActive(){
    //     $strQuery = DB::table('products As a')
    //                 ->join('users As b','a.created_by','=','b.id')
    //                 ->join('products_category As c','a.product_category_id','=','c.id')
    //                 ->where('a.is_active',1)
    //                 ->orderBy('a.updated_at','desc')
    //                 ->select('a.*','b.name as user_name','c.name as category_name');

    //     return $strQuery;
    // }

}