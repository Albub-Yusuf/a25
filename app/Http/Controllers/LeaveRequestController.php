<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\Category;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LeaveRequestController extends Controller
{
    public function report(){
       $data['serial'] = 1;
       $data['notification'] = LeaveRequest::where('is_notified',1)->where('status','pending')->count();
       $currentYear = date('Y');
       $data['leaveRecords'] = LeaveRequest::with('user')->whereYear('updated_at',$currentYear)->where('status','approved')->select(
        'user_id',
        DB::raw('sum(expected_leave_days) as total_off_days'),
        
    )
    ->groupBy('user_id')->orderBy('id','DESC')
    ->get();
      
       return view('leave.report',$data);
    }

    public function waitingList(){
        $data['serial'] = 1;
        $data['leaves'] = LeaveRequest::with(['category','user'])->where('status','pending')->where('is_notified',1)->orderBy('id','DESC')->get();
        $data['notification'] = LeaveRequest::where('is_notified',1)->where('status','pending')->count();
        return view('leave.waitingList',$data);
    }

    public function indexEmployee(){
        $data['serial'] = 1;
        $data['notification'] = LeaveRequest::where('is_notified',1)->where('status','pending')->count();
        $data['leaves'] = LeaveRequest::with('category')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('leave.index',$data);
    }


    public function getRequestForm(){
        $data['categories'] = Category::all();
        $data['notification'] = LeaveRequest::where('is_notified',1)->where('status','pending')->count();

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
            'category_id' => $request->category,
            'user_id' => $request->requestedBy,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'expected_leave_days' => $expectedLeaveDays,
            'status'=>'pending',
            'is_notified'=>1
        ]);

        return back()->with('message','Leave request has been sent!');

      
    }

    public function approvedRequestForm($id){
        $data['leaveDetails'] = LeaveRequest::with(['category','user'])->where('id',$id)->first();
        $data['notification'] = LeaveRequest::where('is_notified',1)->where('status','pending')->count();


       return view('leave.approvedForm',$data);
    }

    public function updateRequest(Request $request){
        
        $request->validate(['status'=>'required']);

       

        LeaveRequest::where('id',$request->id)->update(['status'=>$request->status,'is_notified'=>0]);

        $leaveRequest = [

            'status' => $request->status,
            'email' => $request->employeeEmail,
            'name' => $request->name,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'totalDays' => $request->expectedLeaveDays,
            'leaveType' => $request->leaveType,
            'approvedBy' => $request->approvedBy

        ];

        Mail::to($request->employeeEmail)->send(new NotificationMail($leaveRequest));



        return redirect()->route('admin.waiting.list')->with('message','Decision Given.');

     }
 

    
   
}
