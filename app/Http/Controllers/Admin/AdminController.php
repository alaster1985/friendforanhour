<?php

namespace App\Http\Controllers\Admin;

use App\Complain;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\ProfileStoreRequest;
use App\Profile;
use App\Role;
use App\ServiceList;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function viewAdminUsers()
    {
        $users = User::getAdminUsers();
        return view('admin/viewAdminUsers', ['users' => $users]);
    }

    public function deleteAdminUser($id)
    {
        if (Auth::user()->hasRole('admin')) {
            User::deleteUser($id);
            return redirect()->back()->with('message', 'DONE!');
        } else {
            return redirect()->back()->with('message', 'Something went wrong!');
        }
    }

    public function editAdminUser(Request $request)
    {
        $request->validate([
            'user' => [
                'required',
                Rule::in(User::getAdminUsers()->pluck('id')->all()),
            ],
        ]);
        $roles = Role::getNotAdminAndNotUserRoles();
        $user = User::find($request->user);
        return view('admin/editAdminUser', ['user' => $user, 'roles' => $roles]);
    }

    public function updateAdminUser(AdminUserStoreRequest $request)
    {
        User::updateUser($request);
        return redirect()->back()->with('message', 'DONE!');
    }

    public function createAdminUser()
    {
        $roles = Role::getNotAdminAndNotUserRoles();
        return view('admin/createAdminUser', ['roles' => $roles]);
    }

    public function addAdminUser(AdminUserStoreRequest $request)
    {
        User::addUser($request);
        return redirect()->back()->with('message', 'DONE!');
    }

    public function viewProfileUsers()
    {
        $allProfiles = Profile::all();
        return view('admin/viewProfileUsers', ['profiles' => $allProfiles]);
    }

    public function editProfileUser(Request $request)
    {
        $request->validate([
            'prf' => [
                'required',
                Rule::in(Profile::all()->pluck('id')->all()),
            ],
        ]);
        $profile = Profile::find($request->prf);
        $friendsServices = ServiceList::getServiceListByProfileIdForSponsor($profile->id);
        $sponsorsServices = ServiceList::getServiceListByProfileIdForFriend($profile->id);
        $complainsAgainst = Complain::getAllComplainsAgainstProfileId($profile->id);
        $complainsFrom = Complain::getAllComplainsFromProfileId($profile->id);
        return view('admin/editProfileUser', [
            'profile' => $profile,
            'friendsServices' => $friendsServices,
            'sponsorsServices' => $sponsorsServices,
            'complainsAgainst' => $complainsAgainst,
            'complainsFrom' => $complainsFrom,
            ]);
    }

    public function updateProfileUser(ProfileStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
           Profile::updateProfile($request, User::find($request->user_id));
           $currentProfile = Profile::find($request->profile_id);
           $currentProfile->is_banned = $request->banned;
           $currentProfile->is_locked = $request->locked;
           $currentProfile->save();
        });
        return redirect()->back()->with('message', 'DONE!');
    }
}
