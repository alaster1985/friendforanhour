<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePhoto extends Model
{
    protected $table = 'profile_photos';

    public static function getAllPhotosByProfileId($id)
    {
        return ProfilePhoto::where('profile_id', '=', $id)->get();
    }
}
