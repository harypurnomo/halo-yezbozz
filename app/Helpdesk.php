<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Helpdesk extends Model
{
    protected $table = 'helpdesk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'helpdesk_category_id', 'helpdesk_priority_id', 'sender_user_id', 'sender_name', 'sender_email', 'receiver_user_id', 'receiver_name', 'receiver_email', 'message', 'file_attachement', 'is_read_member', 'is_read_admin', 'is_parent', 'is_active', 'uuid', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getIsParent(){
        $strQuery = DB::table('helpdesk As a')
                    ->join('helpdesk_category As b','a.helpdesk_category_id','=','b.id')
                    ->join('helpdesk_priority As c','a.helpdesk_priority_id','=','c.id')
                    ->where('a.is_parent',1)
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as category_name','c.name as priority_name');
        return $strQuery;
    } 

    public static function getIsParentByMe($userID,$groupID){

        $strQuery = DB::table('helpdesk As a')
                ->join('helpdesk_category As b','a.helpdesk_category_id','=','b.id')
                ->join('helpdesk_priority As c','a.helpdesk_priority_id','=','c.id')
                ->where('a.is_parent',1)
                ->where('a.sender_user_id',$userID)
                ->orderBy('a.updated_at','desc')
                ->select('a.*','b.name as category_name','c.name as priority_name');    
        
        return $strQuery;
    } 

    public static function getByID($id){
        $strQuery = DB::table('helpdesk As a')
                    ->join('helpdesk_category As b','a.helpdesk_category_id','=','b.id')
                    ->join('helpdesk_priority As c','a.helpdesk_priority_id','=','c.id')
                    ->where('a.id',$id)
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as category_name','c.name as priority_name');

        return $strQuery;
    } 

    public static function getByUUID($uuid){
        $strQuery = DB::table('helpdesk As a')
                    ->join('helpdesk_category As b','a.helpdesk_category_id','=','b.id')
                    ->join('helpdesk_priority As c','a.helpdesk_priority_id','=','c.id')
                    ->where('is_parent',0)
                    ->where('a.uuid',$uuid)
                    ->orderBy('a.updated_at','asc')
                    ->select('a.*','b.name as category_name','c.name as priority_name');

        return $strQuery;
    } 
}