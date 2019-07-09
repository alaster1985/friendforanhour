<?php

namespace App;

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
            return Article::where('category_id', $articleCategoryId)->orderBy('created_at', 'desc')->paginate(6);
        }
        return Article::orderBy('created_at', 'desc')->paginate(6);
    }
}
