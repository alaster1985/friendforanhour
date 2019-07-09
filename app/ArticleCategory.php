<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    public function article()
    {
        return $this->hasMany('App\Article');
    }
}
