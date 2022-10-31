<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pages extends Model
{
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'meta_title', 'meta_description', 'meta_keyword', 'statistics', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}