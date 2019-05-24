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
        return ServiceList::where([
            ['profile_id', '=', $id],
            ['is_deleted', '=', 0],
        ])->get();
    }

    public static function getServiceListByProfileIdForSponsor($id)
    {
        return ServiceList::all()
            ->where('profile_id', '=', $id)
            ->where('service_type_id', '=', 1)
            ->where('is_deleted', '=', 0);
    }

    public static function getServiceListByProfileIdForFriend($id)
    {
        return ServiceList::all()
            ->where('profile_id', '=', $id)
            ->where('service_type_id', '=', 2)
            ->where('is_deleted', '=', 0);
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public static function getServiceByServiceListId($serviceListId)
    {
        return ServiceList::find($serviceListId);
    }

    public static function deleteServiceByServiceListId($serviceListId)
    {
        $serviceForDelete = self::getServiceByServiceListId($serviceListId);
        $serviceForDelete->is_deleted = true;
        $serviceForDelete->main_service_marker = false;
        $serviceForDelete->save();
    }

    public static function updateServiceListByProfileId($request, $id)
    {
//        dd($request);
        foreach ($request->service_name as $key => $service_name) {
            if ($key[1] === 'c') {
                $currentService = self::getServiceByServiceListId(substr($key, 2));
                $currentService->service_name = $service_name;
                $currentService->service_description = $request->service_description[$key];
                $currentService->price = $request->price[$key];
                $currentService->is_disabled = $request->is_disabled[$key];
                $currentService->main_service_marker = isset($request->main_service_marker[$key]) ? true : false;
                $currentService->save();
                dd($currentService);
            }
        }

        dd($request);
    }

//    public function profileServiceList()
//    {
//        return $this->hasMany('App\ProfileServiceList');
//    }
}
