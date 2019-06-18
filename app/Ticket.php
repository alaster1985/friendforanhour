<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    protected $fillable = [
        'profile_id',
        'title',
        'description',
        'status_id',
        'moderator_id',
        'report'
    ];
    public function status()
    {
        return $this->belongsTo('App\TicketStatus');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'moderator_id');
    }

    public function getShortDesc()
    {
        return Str::limit($this->description, 53, '...');
    }
}
