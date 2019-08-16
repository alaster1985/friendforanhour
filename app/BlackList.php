<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    public function profileOwnerBL()
    {
        return $this->belongsTo('App\Profile', 'bl_owner_profile_id');
    }

    public function profileNonGrata()
    {
        return $this->belongsTo('App\Profile', 'non_grata_profile_id');
    }

    public static function addToBlackList($request)
    {
        if (!self::checkIfNonGrata($request['profileIdOwner'], $request['profileIdNonGrata'])) {
            $blackList = new BlackList();
            $blackList->bl_owner_profile_id = $request['profileIdOwner'];
            $blackList->non_grata_profile_id = $request['profileIdNonGrata'];
            $blackList->save();
        }
    }

    public static function checkIfNonGrata($profileIdOwner, $profileIdNonGrata)
    {
        $blackList = BlackList::where([
            ['bl_owner_profile_id', $profileIdOwner],
            ['non_grata_profile_id', $profileIdNonGrata],
        ])->first();

        return isset($blackList->id);
    }

    public static function deleteFromList($id)
    {
        $nonGrata = BlackList::find($id);
        return $nonGrata->delete();
    }
}

