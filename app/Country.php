<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function city()
    {
        return $this->hasMany('App\City');
    }

    public static function getAllCountries()
    {
        return Country::all();
    }
}
