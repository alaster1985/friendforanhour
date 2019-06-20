<?php

namespace App\Http\Controllers\Admin;

use App\Ban;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBanRequest;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BanController extends Controller
{
    public function viewProfileBans(Request $request)
    {
        $request->validate([
            'prf' => [
                'required',
                Rule::in(Profile::all()->pluck('id')->all()),
            ],
        ]);
        $bans = Ban::where('profile_id', $request->prf)->orderBy('created_at', 'DESC')->get();
        $profile = Profile::find($request->prf);
        return view('admin/viewBanProfile', ['bans' => $bans, 'profile' => $profile]);
    }

    public function addBan(StoreBanRequest $request)
    {
        Ban::create([
            'profile_id' => $request->profile_id,
            'reason' => $request->reason,
            'moderator_id_beginner' => Auth::id(),
            'duration' => $request->duration,
            'ban_end_date' => Ban::setBanTimeByProfileId($request->duration, $request->profile_id),
        ]);
        return redirect()->back()->with('message', 'DONE!');
    }

    public function editBan(Request $request)
    {
        $request->validate([
            'ban' => [
                'required',
                Rule::in(Ban::all()->pluck('id')->all()),
            ],
        ]);
        $ban = Ban::find($request->ban);
        return view('admin/editBanProfile', ['ban' => $ban]);
    }

    public function updateBan(StoreBanRequest $request)
    {
        Ban::updateBan($request);
        return redirect()->back()->with('message', 'DONE!');
    }

    public function viewBanList(Request $request)
    {
        $request->validate([
            'param' => [
                'required',
                Rule::in(['all', 'current', 'expired',]),
            ],
        ]);

        $bans = Ban::getBanList($request->param);
        return view('admin/viewBanList', ['bans' => $bans]);
    }
}
