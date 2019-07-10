<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleCategory;
use App\News;
use App\Profile;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MainController extends Controller
{
    public function index()
    {
        $newProfiles = Profile::getNewProfiles();
        $profilesForLowerBlocks = Profile::getSixProfilesForLowerBlocks();
        $limit = Auth::check() ? 4 : 1; // count of news for index page
        return view('index', [
            'newProfiles' => $newProfiles,
            'profilesForLowerBlocks' => $profilesForLowerBlocks,
            'news' => $news = News::getLastNews($limit),
        ]);
    }

    public function banned()
    {
        if (Auth::user()->profile->ban->last()->ban_end_date > strtotime('now') || Auth::user()->profile->is_banned) {
            return view('banned');
        }
        return redirect()->route('index');
    }

    public function unpaid()
    {
        if (Auth::user()->profile->subscription_end_date < strtotime('now') || Auth::user()->profile->is_locked) {
            return view('unpaid');
        }
        return redirect()->route('index');
    }

    public function search()
    {
        return view('search');
    }

    public function ok(Request $request)
    {
        $request->validate([
            'OutSum' => 'required',
            'InvId' => 'required',
            'SignatureValue' => 'required',
            'Shp_ProfileId' => 'required',
        ]);
        $out_sum = $request->OutSum;
        $inv_id = $request->InvId;
        $shp_ProfileId = $request->Shp_ProfileId;
        $transaction = Transaction::where([
            ['profile_id', '=', $shp_ProfileId],
            ['inv_id', '=', $inv_id],
            ['accepted', '=', true],
        ])->first();
        if (isset($transaction->id)) {
            $messageOk = "Success! InvoiceID: $inv_id Sum: $out_sum Completed! Internal transaction ID $transaction->id.";
        } else {
            $messageOk = "Something went wrong! Please, contact to support with your InvoiceID: $inv_id";
        }
        return view('allok', ['messageOk' => $messageOk]);
    }

    public function bad(Request $request)
    {
        $request->validate([
            'OutSum' => 'required',
            'InvId' => 'required',
        ]);
        $out_sum = $request->OutSum;
        $inv_id = $request->InvId;
        $messageOk = "You have refused payment InvoiceID: $inv_id Sum: $out_sum";
        return view('allbad', ['messageOk' => $messageOk]);
    }

    public function newsIndex()
    {
        $news = News::where('disabled', false)->get();
        return view('indexNews', ['news' => $news]);
    }

    public function articlesIndex(Request $request)
    {
        $categories = ArticleCategory::pluck('category_name')->all();
        array_push($categories, 'all');
        $request->validate([
            'ctg' => [
                'required',
                Rule::in($categories),
            ],
        ]);
        $articles = Article::getArticleList($request->ctg)->whereDisabled(false)->paginate(6)->appends(request()->except('page'));;
        return view('indexArticles', ['articles' => $articles]);
    }
}
