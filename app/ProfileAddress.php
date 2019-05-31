<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
