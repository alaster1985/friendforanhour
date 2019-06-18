<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $fillable = ['status'];

    public function ticket()
    {
        return $this->hasMany('App\Tickets');
    }
}
