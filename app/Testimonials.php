<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Testimonials extends Model
{
    protected $table = 'testimonials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'full_name', 'company_name', 'testimonial', 'picture', 'star', 'is_active', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}