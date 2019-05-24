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
    public static function createNewCity($request)
    {
        $newCity = new City();
        $newCity->city_name = $request->newCity;
        if ($request->country === 'new') {
            $newCity->country_id = Country::createNewCountry($request);
        } else {
            $newCity->country_id = $request->country;
        }
        $newCity->save();
        return $newCity->id;
    }
}
