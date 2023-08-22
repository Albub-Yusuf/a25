@extends('layouts.dashMaster')

@section('content')

@if(Session::has('message'))

 <script>
 Swal.fire({
  icon: 'success',
  title: "{{Session::get('message')}}",
  

})
</script>
@endif
<div class="row" style="min-height: 75vh;">
<div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Leave History</h4>
                  <div class="table-responsive">
                    <table class="table table-hover" id="leave_history">
                      <thead>
                        <tr>
                          <th>Serial</th>
                          <th>Employee</th>
                          <th>Leave Type</th>
                          <th>Reason</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($leaves as $leave)
                        <tr>
                          <td>{{$serial++}}</td>
                          <td>{{$leave->user->name}}</td>
                          <td>{{$leave->category->category}}</td>
                          <td>{{$leave->reason}}</td>
                          <td>{{$leave->start_date}}</td>
                          <td>{{$leave->end_date}}</td>
                          <td>{{$leave->expected_leave_days}}</td>
                          <td 
                                @if($leave->status=="pending") class="text-secondary" @endif 
                                @if($leave->status=="approved") class="text-success" @endif
                                @if($leave->status=="rejected") class="text-danger" @endif><b>{{$leave->status}}</b></td>
                          <!-- <td><label class="badge badge-danger">Pending</label></td> -->
                          <td><a href="{{route('update.leave.request',$leave->id)}}">Show</a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
</div>


<script>
 $(function() {
   $('#leave_history').DataTable();
 });
</script>
@endsection