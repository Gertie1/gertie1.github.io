<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table="report";

    protected $fillable = [
        'drug_id',
    ];
    public $timestamps=false;
}
