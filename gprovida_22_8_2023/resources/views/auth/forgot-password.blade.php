@extends('layouts.auth')

@section('body')

    <body >
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="{{ asset('images/logo.png') }}" width="180" alt="" />
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="p-2 rounded">

                                    <div class="mb-4 text-sm text-gray-600">
                                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                    </div>
                                    @if(Session::has('status'))
                                        <div class="alert alert-info">
                                            {{Session::get('status')}}
                                        </div>
                                    @endif

                                    <div class="row form-body mt-4 flex items-center justify-between">
                                        <div class="col-12">
                                            <form method="POST" action="{{ route('password.email') }}">
                                                @csrf
                                                <div class="col-12">
                                                    <label  class="form-label">Username</label>
                                                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                                                    @if ($errors->has('username'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="col-12">
                                                    <label  class="form-label">Email Address</label>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="mt-4 text-end">
                                                    <button type="submit" class="btn btn-dark px-5">
                                                        {{ __('Email Password Reset Link') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->


    </body>
@endsection
