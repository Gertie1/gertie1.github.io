<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = [
        'name',
        'mos',
        'pack_size',
        'sale_price',
        'used_stock',
        'date_received',

    ];

    public $timestamps=false;

    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }

    public function disease()
    {
        return $this->belongsToMany('App\Disease');
    }

}













