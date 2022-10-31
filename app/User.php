<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'user_type_id', 'name', 'email', 'address', 'password', 'no_hp', 'mypic', 'is_active', 'is_verified' ,'activation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery=\DB::table('users As a')
                    ->join('groups As b','a.group_id','=','b.group_id')
                    ->leftJoin('user_type As c','a.user_type_id','=','c.type_id')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.group_name','c.type_name');
        
        return $strQuery;
    }

    public static function getJoinRow($params=[],$orderBy='a.id',$order='asc')
    {
        $data=\DB::table('users As a')
                    ->join('groups As b','a.group_id','=','b.group_id')
                    ->join('user_type As c','a.user_type_id','=','c.type_id')
                    ->select('a.*','b.group_name','c.type_name');
        if(count($params)>0) $data=$data->where($params);
        $data=$data->orderBy($orderBy,$order);
        
        return $data;
    }
}
