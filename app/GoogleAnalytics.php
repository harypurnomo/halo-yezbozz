<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GoogleAnalytics extends Model
{
    protected $table = 'google_analytics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'analytics_view_id', 'service_account_credentials_json', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}