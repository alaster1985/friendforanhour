<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Profile extends Model implements ViewableContract
{
    use Viewable;

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

    public function complainFrom()
    {
        return $this->hasMany('App\Complain', 'complain_from_profile_id');
    }

    public function complainAgainst()
    {
        return $this->hasMany('App\Complain', 'complain_against_profile_id');
    }

    public function favoritesOwner()
    {
        return $this->hasMany('App\Favorite', 'f_owner_profile_id');
    }

    public function favoriteProfiles()
    {
        return $this->hasMany('App\Favorite', 'favorite_profile_id');
    }

    public function blackListsOwner()
    {
        return $this->hasMany('App\BlackList', 'bl_owner_profile_id');
    }

    public function blackLists()
    {
        return $this->hasMany('App\BlackList', 'non_grata_profile_id');
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Profile', 'friends', 'profile_id', 'friend_id')->get();
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\Profile', 'friends', 'friend_id', 'profile_id')->get();
    }

    public function friends()
    {
        return $this->friendsOfMine()->merge($this->friendOf());
    }

    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }

    public function ban()
    {
        return $this->hasMany('App\Ban');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }

    public function getAge()
    {
        return date_diff(date_create($this->date_of_birth), date_create('today'))->y;
    }

    public function lastActivity()
    {
        $seconds = strtotime('now') - $this->last_activity;
        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a дней, %h часов, %i минут в назад');
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
        $profile->subscription_end_date = strtotime("+3 day");
        $profile->save();
        $photoFromSocial = $data['photo'] ?? null;
        ProfilePhoto::createNewDefaultProfilePhoto($photoFromSocial, $profile);
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

//    public static function getNewProfiles()
//    {
//        return Profile::orderBy('created_at', 'desc')
//            ->where([
//                ['is_deleted', '=', 0],
//                ['is_locked', '=', 0],
//            ])
//            ->take(10)
//            ->get();
//    }
//
//    public static function getSixProfilesForLowerBlocks()
//    {
//        return Profile::with(['profileAddress', 'serviceList'])
//            ->where([
//                ['is_deleted', '=', 0],
//                ['is_locked', '=', 0],
//            ])
//            ->orderBy('created_at', 'desc')
//            ->take(6)
//            ->get()->filter->profileOnline(false);
//    }

    public static function getSomeProfilesByParam($count, $typeOfSort, $isOnline, $cityId = null)
    {
        return Profile::with(['profileAddress'])
            ->where([
                ['is_deleted', '=', 0],
                ['is_locked', '=', 0],
            ])
            ->where(function ($query) use ($cityId) {
                if ($cityId) {
                    $query->whereHas('profileAddress', function ($q) use ($cityId) {
                        $q->where('city_id', $cityId);;
                    });
                }
            })
            ->orderBy('created_at', $typeOfSort)
            ->take($count)
            ->get()->filter->profileOnline($isOnline);
    }

    public static function setSubscriptionEndDate($profileId)
    {
        $currentProfile = Profile::find($profileId);
        if ($currentProfile->subscription_end_date < strtotime('now')) {
            $currentProfile->subscription_end_date = strtotime('+ 1 month');
        } else {
            $currentProfile->subscription_end_date = strtotime('+ 1 month', $currentProfile->subscription_end_date);
        }
        $currentProfile->save();
    }

    /**
     * method for admin dashboard
     * @param $param = string
     * @return Profile[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getProfilesByParam($param)
    {
        switch ($param) {
            case 'all':
                return Profile::all()->sortByDesc('created_at');
                break;
            case 'current':
                return Profile::all()->where('subscription_end_date', '>=', strtotime('now'))->sortByDesc('created_at');
                break;
            case 'expired':
                return Profile::all()->where('subscription_end_date', '<', strtotime('now'))->sortByDesc('created_at');
                break;
//            case 'demo':
//                return Profile::all()->where('subscribe_end_date', '>=', strtotime('now'))->sortByDesc('created_at');
//                break;
            default:
                return Profile::all()->sortByDesc('created_at');
                break;
        }
    }

    /**
     * method for filter (search)
     * @param $params
     * @return Profile[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getFilteredProfilesByParams($params)
    {
        $minAge = ($params['min_age'] ?? '18') + 1; // +1 for correct between date_of_birth
        $maxAge = ($params['max_age'] ?? '123') + 1; // +1 for correct between date_of_birth
        $latitude = $params['latitude'] ?? null;
        $longitude = $params['longitude'] ?? null;
        $radius = $params['radius'] ?? 25;
        $serviceTypeId = $params['friend_type'];
        $minPrice = $params['min_money'] ?? 0;
        $maxPrice = $params['max_money'] ?? 10000;
        $cityId = $params['city'];
        $minHeight = $params['min_height'] ?? 130;
        $maxHeight = $params['max_height'] ?? 220;
        $minWeight = $params['min_weight'] ?? 30;
        $maxWeight = $params['max_weight'] ?? 280;
        $genderId = $params['gender'];
        $online = $params['online'];

//        $result = Profile::whereHas('gender', function($q){$q->where('gender','male');})->get();
//        $result = Profile::with(['gender', 'profileAddress'])->whereHas('profileAddress.city', function ($q) {$q->where('country_id', 1);})->get();
//        $result = Profile::whereBetween('date_of_birth', [date('Y-m-d', strtotime('-19 years')), date('Y-m-d', strtotime('-18 years'))])->get();
//        $result = Profile::whereHas('profileAddress', function ($q) use ($params) {
//            $q->whereRaw(DB::raw("(6371 * acos( cos( radians(" . $params['latitude'] . ") ) * cos( radians( latitude ) )  *
//                          cos( radians( longitude ) - radians(" . $params['longitude'] . ") ) + sin( radians(" . $params['latitude'] . ") ) * sin(
//                          radians( latitude ) ) ) ) < 1 "));
//        })->get();
//        $result = Profile::whereHas('serviceList', function($q) use ($params){$q->where([
//            ['service_type_id', '=', $params['friend_type']],
//            ['is_disabled', '=', 0],
//            ['is_deleted', '=', 0],
//            ['price', '<', 500],
//        ]);})->get();

        $result = Profile::with(['profileAddress', 'serviceList', 'profilePhoto'])
            ->where([
                ['gender_id', '=', $genderId],
                ['is_deleted', '=', 0],
                ['is_locked', '=', 0],
                ['is_banned', '=', 0],
                ['subscription_end_date', '>=', strtotime('now')],
            ])
            ->whereBetween('height', [$minHeight, $maxHeight])
            ->whereBetween('weight', [$minWeight, $maxWeight])
            ->whereBetween('date_of_birth',
                [
                    date('Y-m-d', strtotime('-' . $maxAge . ' years')),
                    date('Y-m-d', strtotime('-' . $minAge . ' years')),
                ])
            ->whereHas('profileAddress', function ($q) use ($cityId) {
                $q->where('city_id', $cityId);
            })
            ->whereDoesntHave('ban', function ($q) {
                $q->where('ban_end_date', '>', strtotime('now'));
            })
            ->whereHas('serviceList', function ($q) use ($serviceTypeId, $maxPrice, $minPrice) {
                $q->where(
                    [
                        ['service_type_id', '=', $serviceTypeId],
                        ['is_disabled', '=', 0],
                        ['is_deleted', '=', 0],
                    ])
                    ->whereBetween('price', [$minPrice, $maxPrice]);
            })
            ->where(function ($query) use ($latitude, $longitude, $radius) {
                if (isset($latitude) && isset($longitude)) {
                    $query->whereHas('profileAddress', function ($q) use ($latitude, $longitude, $radius) {
                        $q->whereRaw(DB::raw("(6371 * acos( cos( radians(" . $latitude . ") ) * cos( radians( latitude ) )  *
                          cos( radians( longitude ) - radians(" . $longitude . ") ) + sin( radians(" . $latitude . ") ) * sin(
                          radians( latitude ) ) ) ) < " . $radius));
                    });
                }
            })
            ->get()->filter->profileOnline($online);
        return json_encode($result);
    }

    public function profileOnline($param = true)
    {
        if ($param) {
            return Cache::has('profile-in-online-' . $this->id);
        } else {
            return true;

        }
    }

    public static function setLocation($profile, $longitude, $latitude)
    {
        return ProfileAddress::updateProfileLocationByProfileId($profile->id, $longitude, $latitude);
    }

}
