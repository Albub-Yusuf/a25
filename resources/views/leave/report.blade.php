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
<div class="col-lg-10 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Employee Leave Report</h4>
                  <div class="table-responsive">
                    <table class="table table-hover" id="leave_report">
                      <thead>
                        <tr>
                          <th>Serial</th>
                          <th>Employee</th>
                          <th>Total Allocated Leave</th>
                          <th>Total Granted Leave</th>
                          <th>Total Available Leave</th>
                        </tr>
                      </thead>
                      <tbody>
                    @foreach($leaveRecords as $record)
                   <tr>
                    <td>{{$serial++}}</td>
                    <td>{{$record->user->name}}</td>
                    <td>30</td>
                    <td>{{$record->total_off_days}}</td>
                    <td>{{30-$record->total_off_days}}</td>
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
   $('#leave_report').DataTable();
 });
</script>
@endsection