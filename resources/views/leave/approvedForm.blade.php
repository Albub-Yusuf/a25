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

<div class="col-md-10 ">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Leave Request Form</h4>
              <p class="card-description">
                Leave request form
              </p>
              <form class="forms-sample" action="{{route('update.request')}}" method="POST">
                @csrf
                @method('PUT')
            

                <div class="row">
                <div class="col-md-8">
                        <label for="status" style="font-size:18px;"><b>Status:</b></label>
                            <div class="form-group" style="font-size: 18px; font-weight:700;">
                                <select class="form-control" id="status" name="status" style="font-size: 18px; font-weight:700;">
                                   
                                        <option style="font-size: 18px; font-weight:700;" value="approved">Approved</option>
                                        <option style="font-size: 18px; font-weight:700;" value="rejected">Rejected</option>

                                  
                                </select>
                            </div>  
                        @error('approval')
                        <label class="text-danger">{{ $message }}</label>
                            <br>
                        @enderror  

                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-md-4">
                        <label for="name" style="font-size:18px; font-weight:700;">Employee's Name: </label>
                        <input style="font-size:18px;" class="form-control" type="text" readonly value="{{$leaveDetails->user->name}}">
                    </div>
                    <div class="col-md-4">
                        <label style="font-size:18px; font-weight:700; " for="email">Employee's Email: </label>
                        <input style="font-size:18px;" class="form-control" type="text" readonly value="{{$leaveDetails->user->email}}">
                        <input  type="hidden" name="employeeEmail" value="{{$leaveDetails->user->email}}">
                        <input type="hidden" name="id" value="{{$leaveDetails->id}}">
                    </div>
                </div>
                 <div class="row">

                    <div class="col-md-4">
                        <label for="category" style="font-size:18px;"><b>Leave Type:</b></label>
                            <div class="form-group" style="font-size: 18px; font-weight:700;">
                            
                                   
                                        <input type="text" readonly selected style="font-size: 18px; font-weight:700;" class="form-control" value="{{$leaveDetails->category->category}}"></input>
                                  
                            </div>  
                        @error('category')
                        <label class="text-danger">{{ $message }}</label>
                            <br>
                        @enderror  

                    </div>


                    <div class="col-md-4">
                    <label for="startDate"  style="font-size:18px;"><b>Start date:</b></label>
                    @error('startDate')
                         <label class="text-danger">{{ $message }}</label>
                         <br>
                     @enderror 
                     <div class="form-group">
                         <input readonly type="date" value="{{$leaveDetails->start_date}}" class="form-control" id="startDate" value="{{old('startDate')}}" name="startDate" style="font-size:18px;" />
                     </div>  
                   </div>

                   <div class="col-md-4">
                    <label for="endDate" style="font-size:18px;"><b>End date:</b></label>
                    @error('endDate')
                         <label class="text-danger">{{ $message }}</label>
                         <br>
                     @enderror 
                     <div class="form-group">
                         <input readonly value="{{$leaveDetails->start_date}}" type="date" class="form-control" value="{{old('endDate')}}" id="endDate" name="endDate" style="font-size:18px;" />
                     </div>  
                   </div>

                    
                </div>


                <div class="row">
                    <div class="col-md-8">
                        
                    <div class="form-group">
                  <label  for="reason" style="font-size:18px;"><b>Reason:</b></label>
                  @error('reason')
                <label class="text-danger">{{ $message }}</label>
                <br>
                @enderror
                  <textarea readonly rows="5" value="" cols="40" class="form-control" id="reason" name="reason" placeholder="Please provide reason for leave..." style="font-size:18px;"> {{$leaveDetails->reason}} </textarea>
                </div>
                    </div>
                </div>

                  
               
             

                <button type="submit" class="btn btn btn-inverse-primary mr-2">Make Request</button>
              </form>
              
            </div>
          </div>
        </div>





@endsection