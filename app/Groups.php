<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Groups extends Model
{
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'group_name', 'is_active'
    ];

    protected $primaryKey   = 'group_id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}