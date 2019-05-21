<?php

namespace App\Http\Controllers;

use App\ProfilePhoto;
use App\ProfileServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $services = ProfileServiceList::getServicesListByProfileId($user->profile_id);
        $photos = ProfilePhoto::getAllPhotosByProfileId($user->profile_id);
        return view('viewProfile', ['user' => $user, 'services' => $services, 'photos' => $photos]);
    }
}
