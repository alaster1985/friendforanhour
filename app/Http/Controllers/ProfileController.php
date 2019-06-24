<?php

namespace App\Http\Controllers;

use App\City;
use App\Complain;
use App\Country;
use App\Gender;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\SearchRequest;
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
        if (Auth::check()){
            $checkComplain = Complain::checkIfComplainExist(Auth::user()->profile_id, $profile->id);
        } else {
            $checkComplain = true;
        }

        return view('viewProfile', $this->getData($profile), ['checkComplain' => $checkComplain]);
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
        $a = Profile::getFilteredProfilesByParams($request->all());
        dd($a);
    }
}
