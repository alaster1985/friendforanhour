<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'service_types';

    public function serviceList()
    {
        return $this->hasMany('App\ServiceList');
    }
}
