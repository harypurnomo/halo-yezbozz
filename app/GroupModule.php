<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GroupModule extends Model
{
    protected $table = 'group_modules';

    public static function getJoinRow($params=[],$orderBy='b.order',$sort='asc')
    {
        $data = DB::table('group_modules As a')
                    ->leftJoin('modules As b','a.module_id','=','b.module_id')
                    ->where($params)
                    ->orderBy($orderBy,$sort)
                    ->select('a.*','b.module_name','link','category','icon');

        return $data;
    }
}