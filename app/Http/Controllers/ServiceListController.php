<?php

namespace App\Http\Controllers;

use App\ServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceListController extends Controller
{
    public function deleteService($id)
    {
        if (Auth::user()->profile_id === ServiceList::getServiceByServiceListId($id)->profile_id){
            ServiceList::deleteServiceByServiceListId($id);
            return redirect()->back()->with('message', 'DONE!');
        } else {
            return redirect()->back()->with('message', 'something went wrong');
        }
    }
}
