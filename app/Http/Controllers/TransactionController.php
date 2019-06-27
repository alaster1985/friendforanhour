<?php

namespace App\Http\Controllers;

use App\Http\Requests\Add1MOAccessRequest;
use App\Profile;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function payment(Request $request)
    {
        $mrh_pass2 = env('ROBOKASSA_TEST_PASS2');
        $out_summ = $request->OutSum;
        $inv_id = $request->InvId;
        $shp_ProfileId = $request->Shp_ProfileId;
        $shp_TransactionNameId = $request->Shp_TransactionNameId;
        $crc = strtoupper($request->SignatureValue);
        $my_crc = strtoupper(md5($out_summ . ':' . $inv_id . ':' . $mrh_pass2 . ':Shp_ProfileId=:' . $shp_ProfileId . ':Shp_TransactionNameId=' . $shp_TransactionNameId));

        Transaction::create([
            'profile_id' => $shp_ProfileId,
            'transaction_name_id' => $shp_TransactionNameId,
            'crc_signature_value' => $crc,
            'me_crc_signature_value' => $my_crc,
            'inv_id' => $inv_id,
            'accepted' => ($my_crc === $crc),
            'request_json' => json_encode($request->all()),
        ]);

        if ($my_crc != $crc) {
            echo "bad sign\n";
            exit();
        }

        echo "OK$inv_id\n";
        Profile::setSubscriptionEndDate($request->Shp_ProfileId);
    }

    public function viewSubscriptionList()
    {
        return view('admin/viewSubscriptionList', ['transactions' => Transaction::all()]);
    }

    public function viewProfileTransactions(Request $request)
    {
        $request->validate([
            'prf' => [
                'required',
                Rule::in(Profile::all()->pluck('id')->all()),
            ],
        ]);
        $transactions = Transaction::where('profile_id', $request->prf)->orderBy('created_at', 'DESC')->get();
        $profile = Profile::find($request->prf);
        return view('admin/viewProfileTransactions', ['transactions' => $transactions, 'profile' => $profile]);
    }

    public function detailTransaction(Request $request)
    {
        $request->validate([
            'trn' => [
                'required',
                Rule::in(Transaction::all()->pluck('id')->all()),
            ],
        ]);
        $transaction = Transaction::find($request->trn);
        return view('admin/detailTransaction', ['transaction' => $transaction]);
    }

    public function addTransaction(Add1MOAccessRequest $request)
    {
        DB::transaction(function () use ($request)
        {
            Transaction::create([
                'profile_id' => $request->profile_id,
                'transaction_name_id' => 1, // 1/MO access
                'crc_signature_value' => md5(json_encode($request->except('password'))),
                'me_crc_signature_value' => md5(json_encode($request->except('password'))),
                'inv_id' => strtotime('now'),
                'accepted' => true,
                'request_json' => json_encode([
                    'request' => $request->except('password'),
                    'InvId' => strtotime('now'),
                    'moderator_id' => Auth::id(),
                ]),
                'manual_access_reason' => $request->reason,
                'giving_access_moderator_id' => Auth::id(),
            ]);
            Profile::setSubscriptionEndDate($request->profile_id);
        });
        return redirect()->back()->with('message', 'DONE!');
    }
}
