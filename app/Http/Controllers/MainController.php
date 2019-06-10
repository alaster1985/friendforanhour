<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $newProfiles = Profile::getNewProfiles();
        $profilesForLowerBlocks = Profile::getSixProfilesForLowerBlocks();
        return view('index', [
            'newProfiles' => $newProfiles,
            'profilesForLowerBlocks' => $profilesForLowerBlocks,
        ]);
    }
}
