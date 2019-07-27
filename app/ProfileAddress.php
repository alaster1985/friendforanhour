<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProfileAddress extends Model
{
    protected $table = 'profile_addresses';

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public static function getProfileAddressByProfileId($id)
    {
        return Profile::find($id)->profileAddress;
    }

    public static function updateProfileAddressByProfileId($request, $id)
    {
        $profileAddress = self::getProfileAddressByProfileId($id);
        $profileAddress->address = $request->address;
        if ($request->city === 'new') {
            $profileAddress->city_id = City::createNewCity($request);
        } else {
            $profileAddress->city_id = $request->city;
        }

        $profileAddress->save();
        return $profileAddress->id;
    }

    public static function updateProfileLocationByProfileId($profileId, $longitude, $latitude)
    {
        $profileAddress = self::getProfileAddressByProfileId($profileId);
        $profileAddress->longitude = $longitude;
        $profileAddress->latitude = $latitude;
        $profileAddress->save();
        return $profileAddress->id;
    }

    public static function createNewProfileAddress($data)
    {
        $newProfileAddress = new ProfileAddress();
        $newProfileAddress->address = 'unknown';
        $newProfileAddress->latitude = null;
        $newProfileAddress->longitude = null;
        $newProfileAddress->city_id = City::checkCityIfExistByName($data) ?? City::createNewCity($data);
        $newProfileAddress->save();
        return $newProfileAddress->id;
    }

//    public function scopeDistance($query, $lat, $long, $distance)
//    {
//        return $query->having('distance', '<', $distance)
//            ->select(DB::raw("*,
//                     (3959 * ACOS(COS(RADIANS($lat))
//                           * COS(RADIANS(latitude))
//                           * COS(RADIANS($long) - RADIANS(longitude))
//                           + SIN(RADIANS($lat))
//                           * SIN(RADIANS(latitude)))) AS distance")
//            )->get();
//    }

//    public function scopeDistance($query, $lat, $long, $distance)
//    {
//        return ProfileAddress::all()->filter(function ($value, $key) use ($lat, $long, $distance) {
//            $actual = 6371
//                * acos(cos(deg2rad($lat))
//                * cos(deg2rad($value->latitude))
//                * cos(deg2rad($value->longitude) - deg2rad($long))
//                + sin(deg2rad($lat)) * sin(deg2rad($value->latitude)));
//            return $distance > $actual;
//        });
//    }

}
