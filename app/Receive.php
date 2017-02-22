<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{
    protected $table="receives";

    protected $fillable = [
        'quantity_received','drug_id','batch_number','month_received','year_received','expiry_date','complete_received','date_received',
    ];
    public $timestamps=false;
}
