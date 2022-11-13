<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantsType extends Model
{
    protected $table = 'tenant_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'is_active', 'is_remove', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
