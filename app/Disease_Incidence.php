<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease_Incidence extends Model
{
    protected $table="diseases_incidences";

    protected $fillable = [
        'disease',
        'location',
        'year',
        'month',
        'incidence',
        'date',
    ];

    public $timestamps=false;


}
