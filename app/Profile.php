<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function gender()
    {
        return $this->belongsTo('App\Gender');
    }

    public function profileAddress()
    {
        return $this->belongsTo('App\ProfileAddress');
    }

    public function getAge($bdate)
    {
        return date_diff(date_create($bdate), date_create('today'))->y;
    }

    public static function createNewDefaultProfile($data)
    {
        $profile = new Profile();
        $profile->date_of_birth = date("Y-m-d", strtotime(str_replace('.', '-', $data['bdate']))) ?? null;
        $profile->first_name = $data['first_name'] ?? null;
        $profile->second_name = $data['last_name'] ?? null;
        $profile->phone = $data['phone'] ?? null;
        $profile->gender_id = $data['sex'] ?? null;
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
