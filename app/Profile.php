<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public static function createNewDefaultProfile($data)
    {

        $profile = new Profile();
        if ($data['network']) {
            $profile->first_name = $data['first_name'] ?? null;
            $profile->second_name = $data['last_name'] ?? null;
            $profile->date_of_birth = date("Y-m-d", strtotime(str_replace('.', '-', $data['bdate'] ))) ?? null;
            $profile->social_profile = $data['profile'] ?? null;
            $profile->uid = $data['uid'] ?? null;
            $profile->phone = $data['phone'] ?? null;
            $profile->network = $data['network'] ?? null;
            $profile->gender_id = $data['sex'] ?? null;
            $profile->identity = $data['identity'] ?? null;
        }
        $profile->save();
        return $profile;
    }

    public static function adultCheck($date)
    {
        if ($date > date('Y-m-d', strtotime('- 18 years')) || $date <= date('Y-m-d', strtotime('+ 123 years'))) {
            return true;
        } else {
            return false;
        }
    }
}
