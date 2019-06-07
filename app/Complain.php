<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    public function profileFrom()
    {
        return $this->belongsTo('App\Profile', 'complain_from_profile_id');
    }

    public function profileAgainst()
    {
        return $this->belongsTo('App\Profile', 'complain_against_profile_id');
    }

    public static function addComplain($request)
    {
        if (!self::checkIfComplainExist($request['profileIdFrom'], $request['profileIdAgainst'])) {
            $complain = new Complain();
            $complain->complain_from_profile_id = $request['profileIdFrom'];
            $complain->complain_against_profile_id = $request['profileIdAgainst'];
            $complain->description = $request['complain'];
            $complain->save();
        }
    }

    public static function checkIfComplainExist($profileIdFrom, $profileIdAgainst)
    {
        $complain = Complain::where([
            ['complain_from_profile_id', $profileIdFrom],
            ['complain_against_profile_id', $profileIdAgainst],
        ])->first();

        return isset($complain->id);
    }

    public static function getAllComplainsAgainstProfileId($profileId)
    {
        return Complain::where('complain_against_profile_id', $profileId)->get();
    }

    public static function getAllComplainsFromProfileId($profileId)
    {
        return Complain::where('complain_from_profile_id', $profileId)->get();
    }
}
