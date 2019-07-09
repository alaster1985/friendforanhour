<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function viewNews()
    {
        return view('admin/viewNews', ['news' => News::all()]);
    }

    public function editNews(Request $request)
    {
        return view('admin/editNews', ['news' => News::find($request->id)]);
    }

    public function createNews()
    {
        return view('admin/createNews');
    }

    public function addNews(StoreNewsRequest $request)
    {
        News::createNewNews($request->all());
        return redirect()->route('viewNews')->with('message', 'DONE!');
    }

    public function updateNews(StoreNewsRequest $request)
    {
        News::updateNews($request->all());
        return redirect()->back()->with('message', 'DONE!');
    }

    public function newsView(Request $request)
    {
        $request->validate([
            'nws' => [
                'required',
                Rule::in(News::where('disabled', false)->pluck('id')->all()),
            ],
        ]);
        return view('viewNews', ['news' => News::find($request->nws)]);
    }
}
