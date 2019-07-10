<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleCategory;
use App\Http\Requests\StoreArticlesRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function viewArticles(Request $request)
    {
        $categories = ArticleCategory::pluck('category_name')->all();
        array_push($categories, 'all');
        $request->validate([
            'ctg' => [
                'required',
                Rule::in($categories),
            ],
        ]);
        $articles = Article::getArticleList($request->ctg)->paginate(17)->appends(request()->except('page'));;
        $ctg = ArticleCategory::where('category_name', $request->ctg)->first();
        return view('admin/viewArticles', ['articles' => $articles, 'ctg' => $ctg]);
    }

    public function editArticles(Request $request)
    {
        $request->validate([
            'id' => [
                'required',
                Rule::in(Article::pluck('id')->all()),
            ],
        ]);
        return view('admin/editArticles', ['article' => Article::find($request->id)]);
    }

    public function createArticles()
    {
        return view('admin/createArticles');
    }

    public function addArticles(StoreArticlesRequest $request)
    {
        Article::createNewArticle($request->all());
        $ctg = ArticleCategory::find($request->category_id);
        return redirect()->route('viewArticles', ['ctg' => $ctg->category_name])->with('message', 'DONE!');
    }

    public function updateArticles(StoreArticlesRequest $request)
    {
        Article::updateArticle($request->all());
        return redirect()->back()->with('message', 'DONE!');
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
