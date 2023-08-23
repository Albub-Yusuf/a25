<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function dashboard(){
        $currentYear = date('Y');
        $data['notification'] = LeaveRequest::where('is_notified',1)->where('status','pending')->count();
        $data['employeeLeaves'] = LeaveRequest::with('category')->whereYear('updated_at',$currentYear)->where('user_id',Auth::user()->id)->orderBy('id','DESC')->limit(3)->get();
        $data['leaves'] = LeaveRequest::with(['category','user'])->whereYear('updated_at',$currentYear)->where('status','pending')->where('is_notified',1)->orderBy('id','DESC')->limit(3)->get();
        $data['totalApprovedLeave'] = LeaveRequest::where('status','approved')->whereYear('updated_at',$currentYear)->count();
        $data['grantedLeave'] = LeaveRequest::where('status','approved')->whereYear('updated_at',$currentYear)->where('user_id',Auth::user()->id)->sum('expected_leave_days');
        $data['rejectedLeave'] = LeaveRequest::where('status','rejected')->whereYear('updated_at',$currentYear)->where('user_id',Auth::user()->id)->count();
        $data['pendingLeave'] = LeaveRequest::where('status','pending')->whereYear('updated_at',$currentYear)->where('user_id',Auth::user()->id)->count();
        $data['balanceLeave'] = 20 - $data['grantedLeave'];
       

        return view('dashboard2',$data);

    }
}
