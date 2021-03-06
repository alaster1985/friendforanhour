<?php

namespace App;

use App\Services\UploadPhotoService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProfilePhoto extends Model
{
    protected $table = 'profile_photos';

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public static function getAllPhotosByProfileId($id)
    {
        return ProfilePhoto::where([
            ['profile_id', '=', $id],
            ['is_deleted', '=', 0]
        ])->get();
    }

    public static function getProfilePhotoByPhotoId($id)
    {
        return ProfilePhoto::find($id);
    }

    public static function getMainProfilePhotoByProfileId($id)
    {
        return ProfilePhoto::where([
            ['profile_id', '=', $id],
            ['main_photo_marker', '=', 1],
            ['is_deleted', '=', 0]
        ])->first();
    }

    public static function getFirstNotMainProfilePhotoByProfileId($id)
    {
        $allPhotos = self::getAllPhotosByProfileId($id);
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
                $photoForDelete->main_photo_marker = false;
                $newMainPhoto = self::getFirstNotMainProfilePhotoByProfileId($photoForDelete->profile_id);
                $newMainPhoto->main_photo_marker = true;
                $newMainPhoto->save();
            }
            $photoForDelete->is_deleted = true;
            $photoForDelete->save();
        });
    }

    public static function updateProfilePhoto($request)
    {
        DB::transaction(function () use ($request) {
            $disableMainPhoto = self::getMainProfilePhotoByProfileId(Auth::user()->profile_id ?? $request->profileId);
            if (isset($disableMainPhoto->id)){
                $disableMainPhoto->main_photo_marker = false;
                $disableMainPhoto->save();
            }
            if (isset($request->mainPhoto_id)) {
                $photoForUpdate = self::getProfilePhotoByPhotoId($request->mainPhoto_id);
                $photoForUpdate->main_photo_marker = true;
                $photoForUpdate->save();
            }

            if ($request->file) {
                $newProfilePhoto = new ProfilePhoto();
                $newPhoto = new UploadPhotoService();
                $newPhoto->uploadProfilePhoto($request);
                $newProfilePhoto->profile_id = Auth::user()->profile_id ?? $request->profileId;
                $newProfilePhoto->photo_path = $newPhoto->pathFile . $newPhoto->newFileName;
                $newProfilePhoto->main_photo_marker = isset(self::getMainProfilePhotoByProfileId(Auth::user()->profile_id ?? $request->profileId)->id) ? false : true;
                $newProfilePhoto->is_deleted = false;
                $newProfilePhoto->save();
            }
        });
    }

    public static function createNewDefaultProfilePhoto($photoUrl, $profile)
    {
        $newProfilePhoto = new ProfilePhoto();
        $newPhoto = new UploadPhotoService();
        $newPhoto->uploadFirstPhotoFromSocial($photoUrl, $profile);
        $newProfilePhoto->profile_id = $profile->id;
        $newProfilePhoto->photo_path = $newPhoto->pathFile . $newPhoto->newFileName;
        $newProfilePhoto->main_photo_marker = true;
        $newProfilePhoto->is_deleted = false;
        $newProfilePhoto->save();
    }
}
