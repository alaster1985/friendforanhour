<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_id', 'sms_checked', 'uid', 'network', 'social_profile', 'identity',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public static function generateSmsCode()
    {
        return rand(10000, 99999);
    }

    public static function updateUserById($request, $id)
    {
        $user = Auth::user();
        if ($user->id === $id && isset($request->nickname)){
            $user->name = $request->nickname;
            $user->save();
        } else {
            return redirect()->back()->with('message', 'something went wrong');
        }
    }
}
