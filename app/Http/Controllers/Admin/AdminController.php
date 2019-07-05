<?php

namespace App\Http\Controllers\Admin;

use App\Complain;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\SupportFormRequest;
use App\Profile;
use App\Role;
use App\ServiceList;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
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
//        MailController::sendMailForNewModerator($request->all());
        return redirect()->back()->with('message', 'DONE!');
    }

    public function viewProfileUsers(Request $request)
    {
        $request->validate([
            'param' => [
                'required',
                Rule::in(['all', 'current', 'expired', 'demo']),
            ],
        ]);

        $profiles = Profile::getProfilesByParam($request->param);
        return view('admin/viewProfileUsers', ['profiles' => $profiles]);
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
           if (Auth::user()->hasRole('admin')){
               $currentProfile->is_banned = $request->banned;
               $currentProfile->is_locked = $request->locked;
           }
//           $currentProfile->subscription_end_date = 4294967295;
           $currentProfile->save();
        });
        return redirect()->back()->with('message', 'DONE!');
    }

    public function viewTickets()
    {
        $tickets = Ticket::all();
        return view('admin/viewTickets', ['tickets' => $tickets]);
    }

    public function editTicket(Request $request)
    {
        $request->validate([
            'ticket' => [
                'required',
                Rule::in(Ticket::pluck('id')->all())
            ]
        ]);
        return view('admin/editTicket', ['ticket' => Ticket::find($request->ticket)]);
    }

    public function acceptTicket(Request $request)
    {
        $ticket = Ticket::find($request->id);
        $ticket->status_id = 2; //accept status
        $ticket->moderator_id = Auth::id();
        $ticket->save();
        return redirect()->back()->with('message', 'You accept ticket_id' . $request->id);
    }

    public function updateTicket(StoreTicketRequest $request)
    {
        $ticket = Ticket::find($request->id);
        $ticket->report = $request->report;
        $request->status_id == 1 ? $ticket->status_id = 2 : $ticket->status_id = $request->status_id;
        $ticket->moderator_id = Auth::id();
        $ticket->save();
        return redirect()->back()->with('message', 'done');
    }
}
