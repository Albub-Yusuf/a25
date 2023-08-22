<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function indexManager(){
        $data['serial'] = 1;
        return view('leave.index',$data);
    }

    public function indexEmployee(){
        $data['serial'] = 1;
        return view('leave.index',$data);
    }


    public function getRequestForm(){
        $data['categories'] = Category::all();
        return view('leave.requestForm',$data);
    }

    public function makeRequest(Request $request){

        $request->validate([
            'category'=>'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'reason' => 'required'
        ]);

        $toDate = Carbon::parse($request->startDate);
        $fromDate = Carbon::parse($request->endDate);
        $expectedLeaveDays = $toDate->diffInDays($fromDate);

        // protected $fillable = ['reason','leave_type','requested_by','start_date','end_date','expected_leave_days','status','is_notified'];

        LeaveRequest::create([
            'reason' => $request->reason,
            'leave_type' => $request->category,
            'requested_by' => $request->requestedBy,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'expected_leave_days' => $expectedLeaveDays,
            'status'=>'pending',
            'is_notified'=>1
        ]);

        return back()->with('message','Leave request has been sent!');

      
    }

    public function approvedRequestForm(){
       return "approvedRequestForm";
    }

    public function updateRequest(Request $request){
        return "approvedRequestForm";
     }
 

    
   
}
