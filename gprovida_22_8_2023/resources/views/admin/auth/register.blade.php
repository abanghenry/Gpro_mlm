
@extends('admin/AdminLayouts.loginHeader')



@section('content')


<div class="verticalcenter">
  <a href="{{ url('/home') }}"><img src="/adminTemplate/img/logo.png" alt="Logo" class="brand" height="80px" width="430px" /></a>

  <div class="panel panel-primary">
    <div class="panel-body">
      <h4 class="text-center" style="margin-bottom: 25px;">Sign Up</h4>

              @if(Session::has('status'))
                 <div class="alert alert-danger">
                  {{Session::get('status')}}
                 </div>    
              @endif

   <form action="{{ url('admin/register/submit') }}" role="form" method="POST" class="form-horizontal" style="margin-bottom: 0px !important;">
            {{ csrf_field() }}


             <div class="form-group">
              <div class="col-sm-12">
                <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-bars"></i></span>
               <input type="text" class="form-control" id="firstname" placeholder="Firstname" value="{{ old('firstname') }}" name="firstname">

                      @if ($errors->has('firstname'))
                          <span class="help-block">
                              <strong>{{ $errors->first('firstname') }}</strong>
                          </span>
                      @endif
                </div>
              </div>
            </div>

             <div class="form-group">
              <div class="col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                  <input type="text" class="form-control" id="lastname" placeholder="Last name" value="{{ old('lastname') }}" name="lastname">

                        @if ($errors->has('lastname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                        @endif
                </div>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                  <input type="text" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" name="email">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                   @if ($errors->has('username'))
                      <span class="help-block">
                       <strong>{{ $errors->first('username') }}</strong>
                       </span>
                    @endif
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    @if ($errors->has('password'))
                      <span class="help-block">
                       <strong>{{ $errors->first('password') }}</strong>
                       </span>
                    @endif
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        <input type="password" class="form-control" id="password_confirmation" placeholder="Repeat password" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                       <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
            </div>
            <div class="block" style="text-align:center">
              <input type="checkbox" style="margin-right:5px">
              <span>
                I accept the <a href="#">User Agreement</a>
              </span>
            </div>

    <div class="panel-footer">     
      <div class="pull-left">
          <button type="reset" class="btn btn-danger">
             <i class="fa fa-btn "></i> Cancel
         </button>
      </div>
      <div class="pull-right">
          <button type="submit" class="btn btn-primary">
             <i class="fa fa-btn fa-sign-in"></i> Sign up
           </button>
      </div>
    </div>

            
        </form>
          
    </div>
    

  </div>
 </div>



@endsection