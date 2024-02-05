@extends('layouts.auth')

@section('body')
    <body >
        <!--wrapper-->
        <div class="wrapper">
            <div class="authentication-reset-password d-flex align-items-center justify-content-center">
                <div class="row">
                    <div class="col-12 col-lg-10 mx-auto">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-lg-5 border-end">
                                    <div class="card-body">
                                        <div class="p-4">
                                            <div class="text-start">
                                                <img src="{{ asset('images/logo.png') }}" width="180" alt="">
                                            </div>
                                            <h4 class="mt-3 font-weight-bold">Genrate New Password</h4>
                                            <p class="text-muted">We received your reset password request. Please enter your new password!</p>
                                            @if(Session::has('status'))
                                                <div class="alert alert-info">
                                                    {{Session::get('status')}}
                                                </div>
                                            @endif

                                            <form method="POST" action="{{ route('password.update') }}">
                                                @csrf
                                                <!-- Password Reset Token -->
                                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                                <input type="hidden" name="email" value="{{ $request->email }}">
                                                <input type="hidden" name="username" value="{{ $request->username }}">

                                                <div class="mb-1 mt-1">
                                                    <label class="form-label"><strong>Email: {{ $request->email }}</strong></label>
                                                </div>
                                                <div class="mb-1 mt-1">
                                                    <label class="form-label"><strong>Username: {{ $request->username }}</strong></label>
                                                </div>


                                                <div class="mb-3 mt-3">
                                                    <label class="form-label">New Password</label>
                                                    <input type="password" name="password"  class="form-control" required autofocus />
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Confirm Password</label>
                                                    <input type="password" name="password_confirmation"  class="form-control" required />
                                                </div>
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary">  {{ __('Reset Password') }}</button>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <img src="{{ asset('assets/images/login-images/forgot-password-frent-img.jpg') }}" class="card-img login-img h-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end wrapper-->
    </body>
@endsection
