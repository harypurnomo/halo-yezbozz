<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'phone_number', 'email', 'subject', 'message', 'ip', 'is_spam', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('contact_us As a')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*');

        return $strQuery;
    }
}
