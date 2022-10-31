<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class BroadcastLink extends Model
{
    protected $table = 'broadcast_link';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'broadcast_id', 'broadcast_link', 'created_by', 'created_at', 'updated_at'
    ];

    protected $primaryKey   = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}