<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Gender;
use App\Http\Requests\ProfileStoreRequest;
use App\Profile;
use App\ProfilePhoto;
use App\ServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getData($user)
    {
//        $photos = ProfilePhoto::getAllPhotosByProfileId($user->profile_id);
        $friendsServices = ServiceList::getServiceListByProfileIdForSponsor($user->profile_id);
        $sponsorsServices = ServiceList::getServiceListByProfileIdForFriend($user->profile_id);
        return [
            'user' => $user,
//            'photos' => $photos,
            'friendsServices' => $friendsServices,
            'sponsorsServices' => $sponsorsServices,
        ];
    }

    public function index()
    {
        $user = Auth::user();
        return view('viewProfile', $this->getData($user));
    }

    public function edit()
    {
        $user = Auth::user();
        $countries = Country::getAllCountries();
        $cities = City::getAllCitiesByCountryId($user->profile->profileAddress->city->country->id);
        $genders = Gender::getAllGenders();
        $allData = array_merge($this->getData($user),
            ['countries' => $countries, 'cities' => $cities, 'genders' => $genders]);
        return view('editProfile', $allData);
    }

    public function update(ProfileStoreRequest $request)
    {
        $user = Auth::user();
        Profile::updateProfile($request, $user);
        return redirect()->back()->with('message', 'DONE!');
    }
}
