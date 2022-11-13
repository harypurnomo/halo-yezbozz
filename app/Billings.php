<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Billings extends Model
{
    protected $table = 'billings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tenant_id', 'billing_status_id', 'billing_number', 'start_date', 'due_date', 'total', 'desc', 'upload_invoice', 'upload_receipt', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAll(){
        $strQuery = DB::table('billings As a')
                    ->join('billing_status As b','a.billing_status_id','=','b.id')
                    ->join('tenants As c','a.tenant_id','=','c.id')
                    ->select('a.*','b.name As billing_status','c.name as tenant_name');

        return $strQuery;
    } 

}
