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

    public static function createNewCountry($request)
    {
//        if (isset($request->newCountry)){
//            $newCountryName = $request->newCountry;
//        } else {
//            $newCountryName = $request['country'];
//        }
        $newCountryName = isset($request['country']) ? $request['country'] : $request->newCountry;
        $newCountry = new Country();
        $newCountry->country_name = $newCountryName;
        $newCountry->save();
        return $newCountry->id;
    }

    public static function checkCountryIfExistByName($request)
    {
        $countryName = isset($request['country']) ? $request['country'] : $request->newCountry;
        $country = Country::where('country_name', $countryName);
        if (isset($country->id)) {
            return $country->id;
        } else {
            return null;
        }
    }
}
