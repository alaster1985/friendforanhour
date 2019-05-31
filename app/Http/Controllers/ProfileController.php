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
        return view('viewProfile', $this->getData($profile));
    }

    public function edit()
    {
        $user = Auth::user();
        $countries = Country::getAllCountries();
        $cities = City::getAllCitiesByCountryId($user->profile->profileAddress->city->country->id);
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
}
