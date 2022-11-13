<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Market extends Model
{
    protected $table = 'market';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'market_category_id', 'company_name', 'email', 'phone', 'address', 'market_title_en', 'market_title_id', 'market_brief_en', 'market_brief_id', 'market_desc_en', 'market_desc_id', 'slug', 'banner', 'thumb', 'file_attachement', 'is_active', 'is_hot', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('market As a')
                    ->join('market_category As b','a.market_category_id','=','b.id')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as category_name');

        return $strQuery;
    }

    public static function getBySlug($slug){
        $strQuery = DB::table('market As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->join('market_category As c','a.market_category_id','=','c.id')
                    ->where('a.slug',$slug)
                    ->select('a.*','b.name as user_name','c.name as category_name');

        return $strQuery;
    }

}