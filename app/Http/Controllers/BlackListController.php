<?php

namespace App\Http\Controllers;

use App\BlackList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlackListController extends Controller
{
    public function addToBlackList(Request $request)
    {
        BlackList::addToBlackList($request);
    }

    public function index()
    {
        $blacklist = BlackList::where('bl_owner_profile_id', Auth::user()->profile_id)->get();
        return view('viewBlackList', ['blacklist' => $blacklist]);
    }

    public function deleteFromBlackList($id)
    {
        if (isset(BlackList::find($id)->id) && Auth::user()->profile_id === BlackList::find($id)->bl_owner_profile_id){
            BlackList::deleteFromList($id);
        }
        return redirect()->back();
    }
}
