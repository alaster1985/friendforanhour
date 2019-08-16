<?php

namespace App\Http\Controllers;

use App\BlackList;
use App\Chat;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function index()
    {
        $ownersBlacklist = BlackList::where([
            ['bl_owner_profile_id', Auth::user()->profile_id],
        ])->pluck('non_grata_profile_id')->all();
        $blacklistOfMine = BlackList::where([
            ['non_grata_profile_id', Auth::user()->profile_id],
        ])->pluck('bl_owner_profile_id')->all();
        $blacklist = array_merge($ownersBlacklist, $blacklistOfMine);
        $friends = Profile::find(Auth::user()->profile_id)->friends()->whereNotIn('id', $blacklist);
        return view('indexChat', ['friends' => $friends]);
    }


    public function show($id)
    {
        $ownersBlacklist = BlackList::where([
            ['bl_owner_profile_id', Auth::user()->profile_id],
        ])->pluck('non_grata_profile_id')->all();
        $blacklistOfMine = BlackList::where([
            ['non_grata_profile_id', Auth::user()->profile_id],
        ])->pluck('bl_owner_profile_id')->all();
        $blacklist = array_merge($ownersBlacklist, $blacklistOfMine);
        if (in_array($id, $blacklist)) {
            return redirect()->back();
        }
        $friend = Profile::find($id);
        return view('chatShow', ['friend' => $friend]);
    }

    public function getChat($id)
    {
        $this->setReadMark($id);
        return Chat::where(function ($query) use ($id) {
            $query->where('profile_id', '=', Auth::user()->profile_id)->where('friend_id', '=', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('profile_id', '=', $id)->where('friend_id', '=', Auth::user()->profile_id);
        })->orderBy('created_at', 'ASC')->get();
    }

    public function sendChat(Request $request)
    {
        Chat::create([
            'profile_id' => $request->profile_id,
            'friend_id' => $request->friend_id,
            'chat' => $request->chat,
        ]);
    }

    public function setReadMark($id)
    {
        $unReadMessages = Chat::where([
            ['friend_id', '=', Auth::user()->profile_id],
            ['profile_id', '=', $id],
            ['read_mark', '=', false]
        ])->get();
        foreach ($unReadMessages as $uMessage) {
            $uMessage->read_mark = true;
            $uMessage->save();
        }
    }

    public function checkUnreadMessagesFromFriend($id)
    {
        if (Auth::user()->profile_id != $id) {
            return json_encode(Chat::where([
                ['friend_id', '=', Auth::user()->profile_id],
                ['profile_id', '=', $id],
                ['read_mark', '=', false]
            ])->first());
        } else {
            return null;
        }
    }

    public function checkMyUnreadMessagesByFriend($id)
    {
        if (Auth::user()->profile_id != $id) {
            return json_encode(Chat::where([
                ['profile_id', '=', Auth::user()->profile_id],
                ['friend_id', '=', $id],
                ['read_mark', '=', false]
            ])->first());
        } else {
            return null;
        }
    }
}
