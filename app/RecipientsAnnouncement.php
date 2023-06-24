<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class RecipientsAnnouncement extends Model
{
    protected $table = 'recipients_announcement';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'groups_announcement_id', 'name', 'email'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('recipients_announcement As a')
                    ->join('groups_announcement As b','a.groups_announcement_id','=','b.id')
                    ->orderBy('a.groups_announcement_id','asc')
                    ->select('a.*','b.name as group_name');

        return $strQuery;
    }
}