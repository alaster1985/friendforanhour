<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Friend extends Model
{
    protected $fillable = [
        'profile_id', 'friend_id',
    ];

    public static function getAllFriendsByProfileId($id)
    {
        return Friend::where(function ($query) use ($id) {
            $query->where('profile_id', '=', Auth::user()->profile_id)->where('friend_id', '=', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('profile_id', '=', $id)->where('friend_id', '=', Auth::user()->profile_id);
        })->get();
    }
}
