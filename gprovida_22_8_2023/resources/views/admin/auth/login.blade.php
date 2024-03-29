
@extends('admin/AdminLayouts.loginHeader')

@section('content')
<div class="verticalcenter">  

 <a href="{{ url('/home') }}"><img src="/adminTemplate/img/logo2.png" alt="Logo" class="brand" height="80px" width="430px" /></a>
    <div class="panel panel-primary">
       <div class="panel-body">
        <h4 class="text-center" style="margin-bottom: 25px;">Log in to get started or <a href="{{ url('register') }}">Sign Up</a></h4>

              @if(Session::has('status'))
                 <div class="alert alert-danger">
                  {{Session::get('status')}}
                 </div>    
              @endif

                <form action="{{ url('admin/login/submit') }}" class="form-horizontal" role="form" method="POST"  style="margin-bottom: 0px !important;">
                          {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} ">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                     <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"     placeholder="Email">
                                     @if ($errors->has('email'))
                                     <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                     </span>
                                      @endif

                                </div>
                            </div>  
                        </div>
                       
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
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
                        
                        <div class="clearfix">
                            <div class="pull-right"><label><input type="checkbox" name="remember" style="margin-bottom: 20px" checked=""> Remember Me</label></div>
                        </div>




                         <div class="panel-footer">
                        <a href="{{ url('password/reset') }}" class="pull-left btn btn-link" style="padding-left:0">Forgot password?</a>
                        
                            <div class="pull-right">               
                                 <button type="reset" class="btn btn-danger">
                                       <i class="fa fa-btn "></i> Reset
                                  </button>
                                 <button type="submit" class="btn btn-primary">
                                       <i class="fa fa-btn fa-sign-in"></i> Login
                                  </button>

                            </div>
                      </div>


                    </form>
                    
        </div>
           
    </div>
 </div>
      
@endsection