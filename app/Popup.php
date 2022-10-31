<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Popup extends Model
{
    protected $table = 'popup_banner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'text_content', 'close_time', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
