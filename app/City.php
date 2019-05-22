<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function profileAddress()
    {
        return $this->hasMany('App\ProfileAddress');
    }

    public static function getAllCitiesByCountryId($id)
    {
        return City::all()->where('country_id', '=', $id);
    }
}
