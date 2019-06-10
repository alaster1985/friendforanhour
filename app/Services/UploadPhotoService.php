<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\ProfilePhoto;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Mockery\Exception;

class UploadPhotoService extends Controller
{

    public $pathFile;
    public $newFileName;

    public function uploadProfilePhoto($request)
    {
        $image = $request->file;
        $image_resize = Image::make($image->getRealPath());
//        $path = ProfilePhoto::getMainProfilePhotoByProfileId(Auth::user()->profile_id)->photo_path;
//        $path = explode('/', ProfilePhoto::getMainProfilePhotoByProfileId(Auth::user()->profile_id)->photo_path);
//        $this->pathFile = substr($path,0,strrpos($path,'/')) . '/';
        $this->pathFile = 'profilepictures/' . (Auth::user()->profile_id ?? $request->profileId) . '/';
        $image_resize->resize(640, 480);

        $this->newFileName = self::getGUID()
            . '.' . $image->getClientOriginalExtension();
        if (!file_exists($this->pathFile)) {
            mkdir($this->pathFile, 0777, true);
        }
        $image_resize->save($this->pathFile . $this->newFileName);

    }

    public function uploadFirstPhotoFromSocial($photoUrl, $profile)
    {

//        $photoUrl = substr(($photoUrl.'?'), 0, strpos(($photoUrl.'?'), "?"));
        $socialPhoto = Image::make($photoUrl);
//        $socialPhoto = Image::make('profilepictures/' . $profile->gender_id . '.jpg');
        $socialPhoto->resize(640, 480)->encode('jpg');
        $this->pathFile = 'profilepictures/' . $profile->id . '/';
        $this->newFileName = self::getGUID()
            . '.jpg';
        if (!file_exists($this->pathFile)) {
            mkdir($this->pathFile, 0777, true);
        }
        $socialPhoto->save($this->pathFile . $this->newFileName);

    }

    public static function getGUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                . substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12)
                . chr(125);// "}"
            return $uuid;
        }
    }
}
