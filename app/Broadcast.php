<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Broadcast extends Model
{
    protected $table = 'broadcast';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'subject', 'message', 'file_attachement', 'uuid', 'groups_announcement_id', 'created_at', 'updated_at'
    ];

    protected $primaryKey   = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('broadcast As a')
                    ->leftjoin('groups_announcement As b','a.groups_announcement_id','=','b.id')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as group_name');

        return $strQuery;
    }
}