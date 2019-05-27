<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilePhoto extends Model
{
    protected $table = 'profile_photos';

    public static function getAllPhotosByProfileId($id)
    {
        return ProfilePhoto::where('profile_id', '=', $id)->get();
    }

    public static function getProfilePhotoByPhotoId($id)
    {
        return ProfilePhoto::find($id);
    }

    public static function getFirstNotMainProfilePhoto()
    {
        $allPhotos = self::getAllPhotosByProfileId(Auth::user()->profile_id);
        foreach ($allPhotos as $profile_photo) {
            if (!$profile_photo->main_photo_marker) {
                return $profile_photo;
            }
        }
        return $profile_photo;
    }

    public static function removeProfilePhotoByPhotoId($photoId)
    {
        DB::transaction(function () use ($photoId) {
            $photoForDelete = self::getProfilePhotoByPhotoId($photoId);
            if ($photoForDelete->main_photo_marker) {
                $newMainPhoto = self::getFirstNotMainProfilePhoto();
                $newMainPhoto->main_photo_marker = true;
                $newMainPhoto->save();
            }
            $photoForDelete->delete();
        });
    }
}
