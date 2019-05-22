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

    public function profileServiceList()
    {
        return $this->hasMany('App\ProfileServiceList');
    }
}
