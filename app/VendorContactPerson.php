<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class VendorContactPerson extends Model
{
    protected $table = 'vendor_contact_person';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'vendor_id', 'name', 'position', 'email', 'phone', 'avatar', 'ktp',
        'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('vendor_contact_person As a')
                    ->join('vendors As b','a.vendor_id','=','b.id')
                    ->orderBy('a.updated_at','desc')
                    ->select('a.*','b.name as vendor_name');

        return $strQuery;
    }
  
}