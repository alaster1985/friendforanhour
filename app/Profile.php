<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public static function createNewDefaultProfile($data)
    {
        $profile = new Profile();
        if ($data['network']) {
            $profile->first_name = $data['first_name'];
            $profile->second_name = $data['second_name'];
            $profile->date_of_birth = $data['bdate'];
        }
        $profile->save();
        return $profile;
    }
}
