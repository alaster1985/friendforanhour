<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
