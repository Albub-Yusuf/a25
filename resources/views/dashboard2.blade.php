@extends('layouts.dashMaster')
@section('content')
<div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome {{Auth::user()->name}}</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="{{asset('assets/images/dashboard/people.svg')}}" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Dhaka</h4>
                        <h6 class="font-weight-normal">Bangladesh</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- statistics shown here -->
            @if(Auth::user()->role=="employee")
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <a style="text-decoration: none; color:#fff;" href="#">
                    <div class="card-body">
                      <p class="mb-4">Pending Leave Request: </p>
                      <p class="fs-30 mb-2">{{$pendingLeave}}</p>
                      <p></p>
                    </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                   <a style="text-decoration: none; color:#fff;" href="#">
                   <div class="card-body">
                      <p class="mb-4">Total Reject</p>
                      <p class="fs-30 mb-2">{{$rejectedLeave}}</p>
                      <p></p>
                    </div>
                   </a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                  <a style="text-decoration: none; color:#fff;" href="#">
                  <div class="card-body">
                      <p class="mb-4">Total leave spent</p>
                      <p class="fs-30 mb-2">{{$grantedLeave}}</p>
                      <p></p>
                    </div>
                  </a>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Available Leave</p>
                      <p class="fs-30 mb-2">{{$balanceLeave}}</p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            <!-- statistics ends here -->

            <!-- Employee Summarize pending Request -->

            @if(Auth::user()->role=="employee")
         <div class="container-fluid">
         <div class="row">
            <div class="col-md-10 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0 py-3 d-flex justify-content-between"><span>My Recent Leave Requests</span>  <span><a style="font-size: 14px !important; color:#000; font-weight:500;" href="{{route('employee.leave.history')}}">Show All Request</a></span></p>
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                       
                        <!--  -->
                        <tr class="text-center">
                          <th class="pl-0  pb-2 border-bottom">Leave Type</th>
                          <th class="pl-0  pb-2 border-bottom">Start Date</th>
                          <th class="pl-0  pb-2 border-bottom">End Date</th>
                          <th class="pl-0  pb-2 border-bottom">Total</th>
                          <th class="pl-0  pb-2 border-bottom">Status</th>                 
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @foreach($employeeLeaves as $leave)
                        <tr>
                          <td>{{$leave->category->category}}</td>
                          <td>{{$leave->start_date}}</td>
                          <td>{{$leave->end_date}}</td>
                          <td>{{$leave->expected_leave_days}} days</td>
                          <td 
                                @if($leave->status=="pending") class="text-secondary" @endif 
                                @if($leave->status=="approved") class="text-success" @endif
                                @if($leave->status=="rejected") class="text-danger" @endif><b>{{$leave->status}}</b></td>
                          <!-- <td><label class="badge badge-danger">Pending</label></td> -->
                        </tr>
                        @endforeach
                        

                        <!--  -->
                                   
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
         </div>
         @endif

            <!--  -->



            <!-- for manager -->
            @if(Auth::user()->role=="manager")
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <a style="text-decoration: none; color:#fff;" href="#">
                    <div class="card-body">
                      <p class="mb-4">New Leave Request Notification: </p>
                      <p class="fs-30 mb-2">{{$notification}}</p>
                      <p></p>
                    </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                   <a style="text-decoration: none; color:#fff;" href="#">
                   <div class="card-body">
                      <p class="mb-4">Total Employees Leave Approved</p>
                      <p class="fs-30 mb-2">{{$totalApprovedLeave}}</p>          
                      <p></p>
                    </div>
                   </a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                  <a style="text-decoration: none; color:#fff;" href="#">
                  <div class="card-body">
                      <p class="mb-4">Total Leave Spent</p>
                      <p class="fs-30 mb-2">{{$grantedLeave}}</p>
                      <p></p>
                    </div>
                  </a>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">My Available Leave</p>
                      <p class="fs-30 mb-2">{{$balanceLeave}}</p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            <!--  -->
          </div>
     
         @if(Auth::user()->role=="manager")
         <div class="container-fluid">
         <div class="row">
            <div class="col-md-10 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0 py-3 d-flex justify-content-between"><span>Recent Leave Requests</span>  <span><a style="font-size: 14px !important; color:#000; font-weight:500;" href="{{route('admin.waiting.list')}}">Show All Request</a></span></p>
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                       
                        <!--  -->
                        <tr class="text-center">
                          <th class="pl-0  pb-2 border-bottom">Employee</th>
                          <th class="pl-0  pb-2 border-bottom">Leave Type</th>
                          <th class="pl-0  pb-2 border-bottom">Start Date</th>
                          <th class="pl-0  pb-2 border-bottom">End Date</th>
                          <th class="pl-0  pb-2 border-bottom">Total</th>
                          <th class="pl-0  pb-2 border-bottom">Status</th>                 
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @foreach($leaves as $leave)
                        <tr>
                          <td>{{$leave->user->name}}</td>
                          <td>{{$leave->category->category}}</td>
                          <td>{{$leave->start_date}}</td>
                          <td>{{$leave->end_date}}</td>
                          <td>{{$leave->expected_leave_days}} days</td>
                          <td 
                                @if($leave->status=="pending") class="text-secondary" @endif 
                                @if($leave->status=="approved") class="text-success" @endif
                                @if($leave->status=="rejected") class="text-danger" @endif><b>{{$leave->status}}</b></td>
                          <!-- <td><label class="badge badge-danger">Pending</label></td> -->
                        </tr>
                        @endforeach
                       

                        <!--  -->
                                   
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
         </div>
         @endif
@endsection