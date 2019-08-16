<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function addToFavorite(Request $request)
    {
        Favorite::addToFavorites($request);
    }

    public function index()
    {
        $favorites = Favorite::where('f_owner_profile_id', Auth::user()->profile_id)->get();
        return view('viewFavorites', ['favorites' => $favorites]);
    }

    public function deleteFromFavorite($id)
    {
        if (isset(Favorite::find($id)->id) && Auth::user()->profile_id === Favorite::find($id)->f_owner_profile_id){
            Favorite::deleteFromList($id);
        }
        return redirect()->back();
    }
}
