<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportFormRequest;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        return view('contactToSupport');
    }

    public function sendTicket(SupportFormRequest $request)
    {
        Ticket::create($request->all());
        return redirect()->back()->with('message', 'DONE!');
    }

    public function myTickets()
    {
        $profileTickets = Ticket::where('profile_id', Auth::user()->profile_id)->orderBy('created_at', 'DESC')->get();
        return view('profileTickets', ['tickets' => $profileTickets]);
    }
}
