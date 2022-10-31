<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class BroadcastRecipientLinks extends Model
{
    protected $table = 'broadcast_recipients_link';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'broadcast_rec_id', 'broadcast_link', 'is_clicked', 'clicked_at'
    ];

    protected $primaryKey   = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}