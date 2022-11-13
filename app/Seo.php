<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Seo extends Model
{
    protected $table = 'seo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'site_name_en', 'site_name_id', 'meta_title_en', 'meta_title_id', 'meta_description_en', 'meta_description_id', 'meta_keyword_en', 'meta_keyword_id', 'statistics', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}