<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table="weather";

    protected $fillable = [
        'rainfall','year','month','max_temp',
    ];
    public $timestamps=false;
}
