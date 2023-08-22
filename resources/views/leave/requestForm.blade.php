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
              <form class="forms-sample" action="{{route('request.store')}}" method="POST">
                @csrf
                @method('POST')
            

                 <div class="row">

                    <div class="col-md-4">
                        <label for="category" style="font-size:18px;"><b>Select Leave Type:</b></label>
                            <div class="form-group" style="font-size: 18px; font-weight:700;">
                                <select class="form-control" id="category" name="category" style="font-size: 18px; font-weight:700;">
                                    @foreach($categories as $category)
                                        <option style="font-size: 18px; font-weight:700;" value="{{$category->id}}">{{$category->category}}</option>
                                     @endforeach
                                </select>
                            </div>  
                        @error('category')
                        <label class="text-danger">{{ $message }}</label>
                            <br>
                        @enderror  

                    </div>


                    <div class="col-md-4">
                    <label for="startDate" style="font-size:18px;"><b>Start date:</b></label>
                    @error('startDate')
                         <label class="text-danger">{{ $message }}</label>
                         <br>
                     @enderror 
                     <div class="form-group">
                         <input type="date" class="form-control" id="startDate" value="{{old('startDate')}}" name="startDate" style="font-size:18px;" />
                     </div>  
                   </div>

                   <div class="col-md-4">
                    <label for="endDate" style="font-size:18px;"><b>End date:</b></label>
                    @error('endDate')
                         <label class="text-danger">{{ $message }}</label>
                         <br>
                     @enderror 
                     <div class="form-group">
                         <input type="date" class="form-control" value="{{old('endDate')}}" id="endDate" name="endDate" style="font-size:18px;" />
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
                  <textarea  rows="5" cols="40" class="form-control" id="reason" name="reason" placeholder="Please provide reason for leave..." style="font-size:18px;"> {{old('reason')}} </textarea>
                </div>
                    </div>
                </div>

                  
                <input type="hidden" name="requestedBy" value="{{Auth::user()->id}}">
               
             

                <button type="submit" class="btn btn btn-inverse-primary mr-2">Make Request</button>
              </form>
              
            </div>
          </div>
        </div>





@endsection