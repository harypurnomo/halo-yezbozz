<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Articles extends Model
{
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'article_category_id', 'article_title_en', 'article_title_id', 'article_brief_en', 'article_brief_id', 'article_desc_en', 'article_desc_id', 'slug', 'banner', 'thumb', 'file_attachement', 'is_active', 'is_hot', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('articles As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->join('article_category As c','a.article_category_id','=','c.id')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as user_name','c.name as category_name');

        return $strQuery;
    }

    public static function getAllIsActive(){
        $strQuery = DB::table('articles As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->where('a.is_active',1)
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as user_name');

        return $strQuery;
    }

    public static function getAllIsActiveHot(){
        $strQuery = DB::table('articles As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->where('a.is_active',1)
                    ->where('a.is_hot',1)
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as user_name');

        return $strQuery;
    }

    public static function getAllIsActiveLatest(){
        $strQuery = DB::table('articles As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->where('a.is_active',1)
                    ->orderBy('a.updated_at','desc')
                    ->limit(5)
                    ->select('a.*','b.name as user_name');

        return $strQuery;
    }

    public static function getBySlug($slug){
        $strQuery = DB::table('articles As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->join('article_category As c','a.article_category_id','=','c.id')
                    ->where('a.slug',$slug)
                    ->select('a.*','b.name as user_name','c.name as category_name');

        return $strQuery;
    }

    public static function getAboutUs(){
        $strQuery = DB::table('articles As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->where('a.is_active',1)
                    ->where('a.article_category_id',3)
                    ->select('a.*','b.name as user_name');

        return $strQuery;
    }

    public static function getFacilities(){
        $strQuery = DB::table('articles As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->where('a.is_active',1)
                    ->where('a.article_category_id',4)
                    ->select('a.*','b.name as user_name');

        return $strQuery;
    }
}