<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock1 extends Model
{
    protected $table="stocks";

    protected $fillable = [
        'quantity_received','drug_id','batch_number','month_received','year_received','expiry_date','complete_received','date_received',
        'quantity_sold','month_sold','year_sold','complete_sold','date_sold','available_stock',

    ];
    public $timestamps=false;
}
