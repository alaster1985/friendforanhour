<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'profile_id', 'friend_id',
    ];

//    public function profilesOfMine()
//    {
//        return $this->belongsToMany('App\Profile', 'friends', 'profile_id', 'friend_id');
//    }
//
//    public function profileOf()
//    {
//        return $this->belongsToMany('App\Profile', 'friends', 'friend_id', 'profile_id');
//    }

}
