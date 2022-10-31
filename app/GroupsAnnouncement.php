<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GroupsAnnouncement extends Model
{
    protected $table = 'groups_announcement';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'is_active'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}