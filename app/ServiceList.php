<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model
{
    public function serviceType()
    {
        return $this->belongsTo('App\ServiceType');
    }
}
