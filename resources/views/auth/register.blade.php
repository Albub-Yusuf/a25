            @extends('layouts.authMaster')
              @section('content')
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" method="POST" action="{{ route('register') }}">
                @csrf
                @method('POST')
                <div class="form-group">
                <label for="name" style="font-size:18px; font-weight:700;">Name: </label>

                  <input style="font-size:18px; font-weight:700;" type="name" name="name" class="form-control form-control-lg" id="name" placeholder="Enter Your Name">
                </div>
                <div class="form-group">
                <label for="email" style="font-size:18px; font-weight:700;">Email: </label>
                  <input style="font-size:18px; font-weight:700;" type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Enter Email Address">
                </div>
                <div class="form-group">
                    <label for="role" style="font-size:18px; font-weight:700;">User Role: </label>
                    <select style="font-size:18px; font-weight:700;" name="role" id="role" class="form-control form-control=lg">
                        <option value="employee">Employee</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="password" style="font-size:18px; font-weight:700;">Password</label>

                  <input  style="font-size:18px; font-weight:700;" type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter Password">
                </div>

                <div class="form-group">
                <label for="password_confirmation" style="font-size:18px; font-weight:700;">Confirm Password: </label>

                  <input  style="font-size:18px; font-weight:700;" type="password" name="password_confirmation" class="form-control form-control-lg" id="password_confirmation" placeholder="Enter Password Again">
                </div>
                <div class="mt-3">
                  <input type="submit" value="Register" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" />
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="{{route('login')}}" class="text-primary">Login</a>
                </div>
              </form>
              @endsection
          