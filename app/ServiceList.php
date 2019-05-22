<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model
{
    protected $table = 'service_lists';

    public function serviceType()
    {
        return $this->belongsTo('App\ServiceType');
    }

    public static function getAllServicesListByProfileId($id)
    {
        return ServiceList::where('profile_id', '=', $id)->get();
    }

    public static function getServiceListByProfileIdForSponsor($id)
    {
        return ServiceList::all()
            ->where('profile_id', '=', $id)
            ->where('service_type_id', '=', 1);
    }

    public static function getServiceListByProfileIdForFriend($id)
    {
        return ServiceList::all()
            ->where('profile_id', '=', $id)
            ->where('service_type_id', '=', 2);
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

//    public function profileServiceList()
//    {
//        return $this->hasMany('App\ProfileServiceList');
//    }
}
