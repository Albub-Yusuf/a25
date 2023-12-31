
            @extends('layouts.authMaster')
              @section('content')
              <h4>  Hello! let's get started
              </h4>
              <h6 class="font-weight-light">Log in to continue.</h6>
              <form class="pt-3" action="{{route('login')}}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
             
                  <input style="font-size:18px; font-weight:700;" value="{{old('email')}}" type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Enter Email Address">
                </div>
                @error('email')
                        <label class="text-danger"><h4>{{ $message }}</h4></label>
                        <br>
                @enderror  
                <div class="form-group">
                  <input  style="font-size:18px; font-weight:700;" type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter Password">
                </div>
                @error('password')
                        <label class="text-danger"><h4>{{ $message }}</h4></label>
                        <br>
                @enderror 
                <div class="mt-3">
                  <input type="submit" value="Login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="{{route('register')}}" class="text-primary">Create</a>
                </div>
              </form>
              @endsection
           