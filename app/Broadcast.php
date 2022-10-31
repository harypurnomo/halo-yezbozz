<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Broadcast extends Model
{
    protected $table = 'broadcast';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'subject', 'message', 'file_attachement', 'uuid', 'created_at', 'updated_at'
    ];

    protected $primaryKey   = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}