<?php

namespace App\Http\Controllers\Auth;

use App\Profile;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = '/home';
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nickname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'bdate' => ['required'],
            'phone' => ['required', 'string', 'min:10', 'max:13'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
//    protected function create(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//            'profile_id' => Profile::createNewDefaultProfile()->id,
//        ]);
//    }

    protected function newUser($data)
    {
        if (isset($data['network'])) {
            $data['password'] = $data['email'];
        }
        $user = null;
        DB::transaction(function () use ($data, &$user) {
            $profile = Profile::createNewDefaultProfile($data);
            $user = User::create([
                'name' => $data['nickname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'profile_id' => $profile->id,
                'uid' => $data['uid'] ?? null,
                'network' => $data['network'] ?? null,
                'social_profile' => $data['profile'] ?? null,
                'identity' => $data['identity'] ?? null,
                'sms_checked' => true,
            ]);
            $user->attachRole(Role::find(3));
        });
        return $user;
    }

    protected function create(array $data)
    {
        if (Profile::adultCheck(str_replace('.', '-', $data['bdate'] ))) {
            return $this->newUser($data);
        } else {
            return redirect()->back();
        }
    }
}
