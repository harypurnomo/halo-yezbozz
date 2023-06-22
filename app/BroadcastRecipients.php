<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class BroadcastRecipients extends Model
{
    protected $table = 'broadcast_recipients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'broadcast_id', 'broadcast_uuid', 'name', 'email', 'is_status', 'created_at', 'updated_at'
    ];

    protected $primaryKey   = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getDetailUserClick($broadcastId,$email)
    {
        $recLink = DB::table('broadcast_recipients As a')
                    ->join('broadcast_recipients_link As b','a.id','=','b.broadcast_rec_id')
                    ->select('broadcast_link','is_clicked','clicked_at')
                    ->where('b.broadcast_rec_id',$broadcastId)
                    ->where('a.email',$email)
                    ->get();
        
        return $recLink;
    }
}