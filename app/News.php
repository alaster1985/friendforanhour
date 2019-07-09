<?php

namespace App;

use App\Services\UploadPhotoService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Jenssegers\Date\Date;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'photo',
        'disabled',
    ];

    public function getExcerpt()
    {
        return Str::limit($this->content, 53, '...');
    }

    public function getDate()
    {
        return Date::parse($this->created_at)->format('j F');
    }

    public static function createNewNews($data)
    {
        $newNews = new News();
        $newNews->title = $data['title'];
        $newNews->content = $data['content'];
        if (isset($data['photo'])) {
            $newNews->photo = self::uploadNewsPhoto($data['photo']);
        }
        $newNews->save();
    }

    public static function updateNews($data)
    {
        $currentNews = News::find($data['id']);
        $currentNews->title = $data['title'];
        $currentNews->content = $data['content'];
        $currentNews->disabled = $data['disabled'];
        if (isset($data['photo'])) {
            $currentNews->photo = self::uploadNewsPhoto($data['photo']);
        }
        $currentNews->save();
    }

    public static function uploadNewsPhoto($photo)
    {
        $newsPhoto = new UploadPhotoService();
        $newsPhoto->uploadNewsPhoto($photo);
        $photoName = $newsPhoto->newFileName;
        $photoPath = 'images/news/';
        $newNewsPhotoPath = $photoPath . $photoName;
        return $newNewsPhotoPath;
    }

    public static function getLastNews($limit)
    {
        return News::orderBy('created_at', 'DESC')->take($limit)->get();;
    }
}
