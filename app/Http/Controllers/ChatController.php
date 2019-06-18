<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Profile::find(Auth::user()->profile_id)->friends();
        return view('indexChat', ['friends' => $friends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $friend = Profile::find($id);
        return view('chatShow', ['friend' => $friend]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function getChat($id)
    {
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
}
