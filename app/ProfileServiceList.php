<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileServiceList extends Model
{
    protected $table = 'profile_service_lists';

    public static function getServicesListByProfileId($id)
    {
        return ProfileServiceList::where('profile_id', '=', $id)->get();
    }

    public function serviceList()
    {
        return $this->belongsTo('App\ServiceList');
    }
}
