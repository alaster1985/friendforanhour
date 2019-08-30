<?php

namespace App\Http\Controllers;

use App\City;
use App\Complain;
use App\Favorite;
use App\BlackList;
use App\Country;
use App\Gender;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\SearchRequest;
use App\Profile;
use App\ProfilePhoto;
use App\ServiceList;
use CyrildeWit\EloquentViewable\Support\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function getData($profile)
    {
        $photos = ProfilePhoto::getAllPhotosByProfileId($profile->id);
        $friendsServices = ServiceList::getServiceListByProfileIdForSponsor($profile->id);
        $sponsorsServices = ServiceList::getServiceListByProfileIdForFriend($profile->id);
        return [
            'profile' => $profile,
            'photos' => $photos,
            'friendsServices' => $friendsServices,
            'sponsorsServices' => $sponsorsServices,
        ];
    }

    public function index(Request $request)
    {
        $request->validate([
            'prf' => [
                'required',
                Rule::in(Profile::pluck('id')->all()),
            ],
        ]);
        $profile = Profile::find($request['prf']);
        views($profile)->delayInSession(2)->record();
        $counters['total'] = views($profile)->unique()->count();
        $counters['week'] = views($profile)->unique()->period(Period::pastWeeks(1))->count();
        $checkers = $this->getCheckers($profile->id);
        $dataArr = array_merge($checkers, $counters);
        return view('viewProfile', $this->getData($profile), $dataArr);
    }

    public function getCheckers($profileId)
    {
        if (Auth::check()) {
            $checkComplain = Complain::checkIfComplainExist(Auth::user()->profile_id, $profileId);
            $checkFavorite = Favorite::checkIfFavorite(Auth::user()->profile_id, $profileId);
            $checkBlackList = BlackList::checkIfNonGrata(Auth::user()->profile_id, $profileId);
        } else {
            $checkComplain = true;
            $checkFavorite = true;
            $checkBlackList = true;
        }

        return [
            'checkComplain' => $checkComplain,
            'checkFavorite' => $checkFavorite,
            'checkBlackList' => $checkBlackList,

        ];
    }

    public function edit()
    {
        $user = Auth::user();
        $user->profile->profileAddress->city_id ? $countryId = $user->profile->profileAddress->city->country->id : $countryId = null;
        $countries = Country::getAllCountries();
        $cities = City::getAllCitiesByCountryId($countryId);
        $genders = Gender::getAllGenders();
        $allData = array_merge($this->getData(Profile::find($user->profile_id)),
            ['countries' => $countries, 'cities' => $cities, 'genders' => $genders]);
        return view('editProfile', $allData);
    }

    public function update(ProfileStoreRequest $request)
    {
        $user = Auth::user();
        Profile::updateProfile($request, $user);
        return redirect()->back()->with('message', 'DONE!');
    }

    public function addComplain(Request $request)
    {
        Complain::addComplain($request);
    }

    public function filter(SearchRequest $request)
    {
        $result = Profile::getFilteredProfilesByParams($request->all());
        return $result;
        // return redirect()->back()->with('message', $result);
    }

    public function setProfileLocation(LocationStoreRequest $request)
    {
        $profile = Profile::find(Auth::user()->profile_id);
        Profile::setLocation($profile, $request->longitude, $request->latitude);
        $newLocation = [
            'longitude' => $profile->profileAddress->longitude,
            'latitude' => $profile->profileAddress->latitude,
        ];
        return json_encode($newLocation);
    }

    public function getAllProfiles()
    {
        return json_encode(Profile::with(['profileAddress', 'serviceList', 'profilePhoto', 'gender'])->get());
    }

    public function getProfilesByChordsAndRadius(Request $request)
    {
        if (empty($request['longitude']) || empty($request['latitude'])) {
            $longitude = 37.61556;
            $latitude = 55.75222;
        } else {
            $longitude = $request['longitude'];
            $latitude = $request['latitude'];
        }
        $radius = $request['radius'] ?? 25;
        $result = Profile::getProfilesByChordsAndRadius($longitude, $latitude, $radius);
        return $result;
    }
}
