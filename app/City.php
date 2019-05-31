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

    public static function getAllCities()
    {
        return City::all();
    }

    public static function getAllCitiesByCountryId($id)
    {
        if (!$id) {
            return self::getAllCities();
        }
        return City::all()->where('country_id', '=', $id);
    }

    public static function createNewCity($request)
    {
        $newCity = new City();
        if (isset($request->newCity)) {
            $newCityName = $request->newCity;
            $country = $request->country;
            if ($country === 'new') {
                $newCity->country_id = Country::checkCountryIfExistByName($request) ?? Country::createNewCountry($request);
            } else {
                $newCity->country_id = $country;
            }
        } else {
            $newCityName = $request['city'];
            $newCity->country_id = Country::checkCountryIfExistByName($request) ?? Country::createNewCountry($request);
        }
        $newCity->city_name = $newCityName;
        $newCity->save();
        return $newCity->id;
    }

    public static function checkCityIfExistByName($request)
    {
        $cityName = $request['city'];
        $city = City::where('city_name', $cityName);
        if (isset($city->id)) {
            return $city->id;
        } else {
            return null;
        }
    }

}
