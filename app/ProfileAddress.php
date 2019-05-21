<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileAddress extends Model
{
    protected $table = 'profile_addresses';

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
