<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_id',
        'sms_checked',
        'uid',
        'network',
        'social_profile',
        'identity',
        'is_deleted',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }

    public function banBeginner()
    {
        return $this->hasMany('App\Ban', 'moderator_id_beginner');
    }

    public function banAmnesty()
    {
        return $this->hasMany('App\Ban', 'moderator_id_amnesty');
    }

    public function givingAccessModer()
    {
        return $this->hasMany('App\Transaction', 'giving_access_moderator_id');
    }

    public static function generateSmsCode()
    {
        return rand(10000, 99999);
    }

    public static function updateUserUserById($request, $id)
    {
        $user = Auth::user();
        if ($user->id === $id && isset($request->nickname)) {
            $user->name = $request->nickname;
            $user->save();
        } else {
            return redirect()->back()->with('message', 'something went wrong');
        }
    }

    public static function getAdminUsers()
    {
        $users = User::whereRoleIs('moderator')->orWhereRoleIs('admin')->get()->where('is_deleted', '=', 0);
        return $users;
    }

    public static function deleteUser($id)
    {
        $userForDelete = User::find($id);
        $userForDelete->is_deleted = 1;
        $userForDelete->password = Hash::make('default' . $userForDelete->name);
        $userForDelete->save();
    }

    public static function updateUser($request)
    {
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles()->sync(Role::find($request->role));
        $user->save();
    }

    public static function addUser($request)
    {
        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->profile_id = null;
        $newUser->save();
        $newUser->attachRole(Role::find($request->role));
    }

}
