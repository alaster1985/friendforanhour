<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\StoreArticlesRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function viewArticles(Request $request)
    {
        return view('admin/viewArticles');
    }

    public function editArticles(Request $request)
    {
        return view('admin/editArticles', ['news' => Article::find($request->id)]);
    }

    public function createArticles()
    {
        return view('admin/createArticles');
    }

    public function addArticles(StoreArticlesRequest $request)
    {
        dd($request);
    }
}
