<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $newProfiles = Profile::getNewProfiles();
        $profilesForLowerBlocks = Profile::getSixProfilesForLowerBlocks();
        return view('index', [
            'newProfiles' => $newProfiles,
            'profilesForLowerBlocks' => $profilesForLowerBlocks,
        ]);
    }

    public function banned()
    {
        if (Auth::user()->profile->ban->last()->ban_end_date > strtotime('now') || Auth::user()->profile->is_banned) {
            return view('banned');
        }
        return redirect()->route('index');
    }

    public function unpaid()
    {
        if (Auth::user()->profile->subscription_end_date < strtotime('now') || Auth::user()->profile->is_locked) {
            return view('unpaid');
        }
        return redirect()->route('index');
    }
}
