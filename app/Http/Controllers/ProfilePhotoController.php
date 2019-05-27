<?php

namespace App\Http\Controllers;

use App\ProfilePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilePhotoController extends Controller
{
    public function getPhotos()
    {
        return ProfilePhoto::getAllPhotosByProfileId(Auth::user()->profile_id);
    }

    public function removePhoto(Request $request)
    {
        return ProfilePhoto::removeProfilePhotoByPhotoId($request->photo_id);
    }

    public function updatePhoto(Request $request)
    {
        ProfilePhoto::updateProfilePhoto($request);
    }
}
