<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserType extends Model
{
    protected $table = 'user_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id', 'type_name', 'is_active'
    ];

    protected $primaryKey = 'type_id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}