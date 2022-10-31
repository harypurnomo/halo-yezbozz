<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Events extends Model
{
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'event_category_id', 'event_title_en', 'event_title_id', 'event_brief_en', 'event_brief_id', 'event_desc_en', 'event_desc_id', 'slug', 'banner', 'thumb', 'file_attachement', 'is_active', 'is_hot', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('events As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->join('event_category As c','a.event_category_id','=','c.id')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as user_name','c.name as category_name');

        return $strQuery;
    }

    public static function getAllIsActive(){
        $strQuery = DB::table('events As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->where('a.is_active',1)
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as user_name');

        return $strQuery;
    }

    public static function getAllIsActiveHot(){
        $strQuery = DB::table('events As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->where('a.is_active',1)
                    ->where('a.is_hot',1)
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as user_name');

        return $strQuery;
    }

    public static function getAllIsActiveLatest(){
        $strQuery = DB::table('events As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->where('a.is_active',1)
                    ->orderBy('a.updated_at','desc')
                    ->limit(5)
                    ->select('a.*','b.name as user_name');

        return $strQuery;
    }

    public static function getBySlug($slug){
        $strQuery = DB::table('events As a')
                    ->join('users As b','a.created_by','=','b.id')
                    ->join('event_category As c','a.event_category_id','=','c.id')
                    ->where('a.slug',$slug)
                    ->select('a.*','b.name as user_name','c.name as category_name');

        return $strQuery;
    }
}