<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function payment(Request $request)
    {
//        dd($request);
        DB::transaction(function () use ($request) {
            Transaction::create([
                'profile_id' => $request->profile_id,
                'transaction_name_id' => $request->transaction_name_id,
            ]);
            Profile::setSubscriptionEndDate($request->profile_id);
        });

        return redirect()->back()->with('message', 'DONE!');
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
}
