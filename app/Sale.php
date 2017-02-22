<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table="sales";

    protected $fillable = [
        'quantity_sold','drug_id','batch_number','month_sold','year_sold','complete_sold','date_sold','total_price',
    ];
    public $timestamps=false;
}
