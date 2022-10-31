<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CompanyProfile extends Model
{
    protected $table = 'company_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'company_name', 'logo', 'favicon', 'company_brief_en', 'company_brief_id', 'email', 'phone_number', 'whatsapp_number', 'address', 'fax', 'instagram', 'youtube', 'facebook', 'twitter', 'linkedin', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}