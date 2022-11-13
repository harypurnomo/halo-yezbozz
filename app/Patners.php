<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patners extends Model
{
    protected $table = 'patners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'picture', 'sort', 'is_active', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
