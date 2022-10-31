<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Modules extends Model
{
    protected $table = 'modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_id', 'module_name', 'category', 'parent_id', 'link', 'icon', 'order', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    protected $primaryKey = 'module_id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getJoinRow($params=[],$orderBy='a.order',$sort='asc')
    {
        $data = DB::table('modules As a')
                    ->leftJoin('modules As b','a.parent_id','=','b.module_id')
                    ->where($params)
                    ->orderBy($orderBy,$sort)
                    ->select('a.*','b.module_name As parent');

        return $data;
    }
}
