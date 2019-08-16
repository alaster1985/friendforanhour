<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function profileOwnerFavorite()
    {
        return $this->belongsTo('App\Profile', 'f_owner_profile_id');
    }

    public function profileFavorite()
    {
        return $this->belongsTo('App\Profile', 'favorite_profile_id');
    }

    public static function addToFavorites($request)
    {
        if (!self::checkIfFavorite($request['profileIdOwner'], $request['profileIdFavorite'])) {
            $favorite = new Favorite();
            $favorite->f_owner_profile_id = $request['profileIdOwner'];
            $favorite->favorite_profile_id = $request['profileIdFavorite'];
            $favorite->save();
        }
    }

    public static function checkIfFavorite($profileIdOwner, $profileIdFavorite)
    {
        $favorite = Favorite::where([
            ['f_owner_profile_id', $profileIdOwner],
            ['favorite_profile_id', $profileIdFavorite],
        ])->first();

        return isset($favorite->id);
    }

    public static function deleteFromList($id)
    {
        $nonGrata = Favorite::find($id);
        return $nonGrata->delete();
    }
}
