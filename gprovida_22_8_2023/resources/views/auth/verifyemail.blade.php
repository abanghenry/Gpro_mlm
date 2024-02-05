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
                                <div class="p-4 rounded">

                                    <div class="mb-4 text-sm text-gray-600">
                                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                    </div>

                                    @if (session('status') == 'verification-link-sent')
                                        <div class="mb-4 text-success">
                                            <strong>
                                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                            </strong>
                                        </div>
                                    @endif

                                    <div class="row form-body mt-4 flex items-center justify-between">
                                        <div class="col-9">
                                            <form method="POST" action="{{ route('verification.send') }}">
                                                @csrf
                                                <div>
                                                    <button type="submit" class="btn btn-dark px-5">
                                                        {{ __('Resend Verification Email') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-3 text-end" style="margin: auto;">
                                            <a class="text-dark" style="text-decoration-line: underline;" href="{{ route('logout') }}">
                                                {{ __('Log Out') }}
                                            </a>
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
