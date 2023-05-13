<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class VendorsOrderHistory extends Model
{
    protected $table = 'vendor_order_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'vendor_id', 'name', 'file_attachement',
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
        $strQuery = DB::table('vendor_order_history As a')
                    ->join('vendors As b','a.vendor_id','=','b.id')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as vendor_name');

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