<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table="inventories";

    protected $fillable = [
        'quantity_received','drug_id','batch_number','month_received','year_received','expiry_date','complete_received','date_received',
        'quantity_sold','month_sold','year_sold','complete_sold','date_sold',
    ];
    public $timestamps=false;
}
