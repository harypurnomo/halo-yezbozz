<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class HelpdeskCategory extends Model
{
    protected $table = 'helpdesk_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'pic_user_id', 'pic_name', 'pic_email', 'is_active'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}