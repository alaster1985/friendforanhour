<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function serviceList()
    {
        return $this->hasMany('App\ServiceList');
    }

    public function profileAddress()
    {
        return $this->belongsTo('App\ProfileAddress');
    }

    public function profilePhoto()
    {
        return $this->hasMany('App\ProfilePhoto');
    }

    public function getAge($bdate)
    {
        return date_diff(date_create($bdate), date_create('today'))->y;
    }

    public static function createNewDefaultProfile($data)
    {
        $profile = new Profile();
        $profile->date_of_birth = date("Y-m-d", strtotime(str_replace('.', '-', $data['bdate'])));
        $profile->first_name = $data['first_name'] ?? null;
        $profile->second_name = $data['last_name'] ?? null;
        $profile->phone = $data['phone'] ?? null;
        $profile->gender_id = $data['sex'] ?? null;
        $profile->profile_address_id = ProfileAddress::createNewProfileAddress($data);
        $profile->save();
        $photoFromSocial = $data['photo'] ?? null;
        ProfilePhoto::createNewDefaultProfilePhoto($photoFromSocial, $profile->id);
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

    public static function updateProfile($request, $user)
    {
//        dd($request);

//        if (!self::adultCheck($request->date_of_birth)){
//            return redirect()->back()->with('message', 'something went wrong');
//        }
        DB::transaction(function () use ($request, $user) {
            $currentProfile = Profile::find($user->profile_id);
            $currentProfile->first_name = $request->first_name;
            $currentProfile->second_name = $request->second_name;
            $currentProfile->date_of_birth = $request->bdate;
            $currentProfile->about = $request->about;
            $currentProfile->height = $request->height;
            $currentProfile->weight = $request->weight;
            $currentProfile->gender_id = $request->gender;
            $currentProfile->phone = $request->phone;
            $currentProfile->profile_address_id = ProfileAddress::updateProfileAddressByProfileId($request,
                $user->profile_id);
            User::updateUserUserById($request, $user->id);
            ServiceList::updateServiceListByProfileId($request, $user->profile_id);
            $currentProfile->save();
        });
    }

    //last 10 records for "new friends"
    public static function getNewProfiles()
    {
        return Profile::orderBy('created_at', 'desc')
            ->where([
                ['is_deleted', '=', 0],
                ['is_locked', '=', 0],
            ])
            ->take(10)
            ->get();
    }

    public static function getSixProfilesForLowerBlocks()
    {
        return Profile::orderBy('created_at', 'asc')
            ->where([
                ['is_deleted', '=', 0],
                ['is_locked', '=', 0],
            ])
            ->take(6)
            ->get();
    }
}
