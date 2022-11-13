<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
  protected $table = 'subscribe';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'ip'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
