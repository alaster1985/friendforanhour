<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public static function sendMailForNewModerator($params)
    {
        $eol = "\r\n";
        $to = $params['email'];
        $subject = 'Hello ' . $params['name'] . '!';
        $message = $subject . $eol
            . 'Welcome to our team!' . $eol
            . 'Your email is a login for authorization.' . $eol
            . 'So, your access data below:' . $eol
            . 'Your login is: ' . $params['email'] . $eol
            . 'Your password is: ' . $params['password'] . $eol
            . 'You can find a dashboard in the top right drop list menu. Just click on your name (' . $params['name'] . ')' . $eol
            . 'Tnx, and good luck!' . $eol;
        mail($to, $subject, $message);
    }

    public static function sendBanEmail($params)
    {
        $profile = Profile::find($params['profile_id']);
        $eol = "\r\n";
        $to = $profile->user->email;
        $subject = 'Hello ' . $profile->user->name . '!';
        $message = $subject . $eol
            . 'Dear ' . $profile->first_name . ' ' . $profile->second_name . '!' . $eol
            . 'You has been banned for ' . $params['duration'] . ' hours.' . $eol
            . 'The reason for your ban is: ' . $params['reason'] . '.' . $eol
            . 'Don\'t be upset about it.' . $eol
            . 'See you later. And don\'t do it again.' . $eol
            . 'Good luck!' . $eol;
        mail($to, $subject, $message);
    }
}
