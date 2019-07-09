<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\StoreArticlesRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function articlesView(Request $request)
    {
        $request->validate([
            'art' => [
                'required',
                Rule::in(Article::where('disabled', false)->pluck('id')->all()),
            ],
        ]);
        return view('viewArticles', ['article' => Article::find($request->art)]);
    }
}
