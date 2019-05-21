<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UloginController extends RegisterController
{
    // Login user through social network.
    public function login(Request $request)
    {

        // Get information about user.
        $data = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($data, true);

        // Find user in DB.
        $userData = User::where('email', $user['email'])->first();

        // Check exist user.
        if (isset($userData->id)) {

            // Check user status.
            if ($userData->sms_checked) {

                // Make login user.
                Auth::loginUsingId($userData->id, true);
            } // Wrong status.
            else {
                Session::flash('flash_message_error', trans('interface.AccountNotActive'));
            }

            return Redirect::back();
        } // Make registration new user.
        else {

            $newRegistration = new RegisterController();
            $newRegistration->create($user);
            $newUser = User::where('email', $user['email'])->first();

//            // Create new user in DB.
//            $newUser = User::create([
//                'nik' => $user['nickname'],
//                'name' => $user['first_name'] . ' ' . $user['last_name'],
//                'avatar' => $user['photo'],
//                'country' => $user['country'],
//                'email' => $user['email'],
//                'password' => Hash::make(str_random(8)),
//                'role' => 'user',
//                'status' => TRUE,
//                'ip' => $request->ip()
//            ]);
//
//            // Make login user.
            Auth::loginUsingId($newUser->id, TRUE);
//
//            \Session::flash('flash_message', trans('interface.ActivatedSuccess'));
//
            return Redirect::route('home');
        }
    }
}
