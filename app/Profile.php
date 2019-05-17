<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public static function createNewDefaultProfile()
    {
        $profile = new Profile();
        $profile->save();
        return $profile;
    }
}
