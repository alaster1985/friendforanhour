<?php

namespace App;

use App\Services\UploadPhotoService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Jenssegers\Date\Date;

class Article extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'photo',
        'disabled',
    ];

    public function category()
    {
        return $this->belongsTo('App\ArticleCategory', 'category_id');
    }

    public function getExcerpt()
    {
        return Str::limit($this->content, 53, '...');
    }

    public function getDate()
    {
        return Date::parse($this->created_at)->format('j F');
    }

    public static function getArticleList($param)
    {
        if ($param != 'all') {
            $articleCategoryId = ArticleCategory::where('category_name', $param)->first()->id;
            return Article::where('category_id', $articleCategoryId)->orderBy('created_at', 'desc');
        }
        return Article::orderBy('created_at', 'desc');
    }

    public static function createNewArticle($data)
    {
        $newArticle = new Article();
        $newArticle->title = $data['title'];
        $newArticle->content = $data['content'];
        $newArticle->category_id = $data['category_id'];
        if (isset($data['photo'])) {
            $newArticle->photo = self::uploadNewsPhoto($data['photo']);
        }
        $newArticle->save();
    }

    public static function updateArticle($data)
    {
        $currentArticle = Article::find($data['id']);
        $currentArticle->title = $data['title'];
        $currentArticle->content = $data['content'];
        $currentArticle->disabled = $data['disabled'];
        $currentArticle->category_id = $data['category_id'];
        if (isset($data['photo'])) {
            $currentArticle->photo = self::uploadNewsPhoto($data['photo']);
        }
        $currentArticle->save();
    }

    public static function uploadNewsPhoto($photo)
    {
        $articlePhoto = new UploadPhotoService();
        $articlePhoto->uploadArticlePhoto($photo);
        $photoName = $articlePhoto->newFileName;
        $photoPath = 'images/articles/';
        $newArticlePhotoPath = $photoPath . $photoName;
        return $newArticlePhotoPath;
    }
}
