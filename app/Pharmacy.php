<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{

    protected $fillable = [
        'location','name'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function drugs()
    {
        return $this->hasMany('App\Drug');
    }

    public $timestamps=false;
}
