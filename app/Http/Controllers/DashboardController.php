<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard(){
        $data['notification'] = LeaveRequest::where('is_notified',1)->where('status','pending')->count();
        return view('dashboard2',$data);

    }
}
