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

//        dd($user);

        // Find user in DB.
        $userData = User::where('email', $user['email'])
            ->orWhere('uid', $user['uid'])
            ->first();

        // Check exist user.
        if (isset($userData->id)) {

            // Check user status.
            if ($userData->sms_checked) {

                // Make login user.
                Auth::loginUsingId($userData->id, true);
            } else { // Wrong status.
                Session::flash('flash_message_error', trans('interface.AccountNotActive'));
            }

            return Redirect::route('index');
        } else {

            // Make registration new user.
            $newRegistration = new RegisterController();
            $newRegistration->create($user);
            $newUser = User::where('email', $user['email'])->first();

            // Make login user.
            Auth::loginUsingId($newUser->id, true);

//            \Session::flash('flash_message', trans('interface.ActivatedSuccess'));

            return Redirect::route('index');
        }
    }
}
