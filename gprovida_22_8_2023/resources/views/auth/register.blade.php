@extends('layouts.auth')

@section("style")
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    <style>
        .active{
            color: #fff !important;
            border-color: #008cff !important;
            background: #008cff !important;
            cursor: pointer;
        }
        .show{
            visibility: visible;
        }
        .hide{
            visibility: hidden;
        }
        .wizard-content{
            min-height: 351px;
        }
    </style>
@endsection

@section('body')
    <body>
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row">
                    <div class="col-9 mx-auto">
                        <div class="my-4 text-center">
                            <img src="{{ asset('images/logo.png') }}" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign Up</h3>
                                        <p>Already have an account? <a href="{{ url('/login') }}">Sign in here</a>
                                        </p>
                                    </div>

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong>We Encountered some problems<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                    <form action="{{ url('/register') }}"  method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="currency_id" value="{{ $currency->id }}">

                                            <div id="smartwizard">
                                                <ul class="nav">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#step-1">	<strong>Profile</strong></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#step-2">	<strong>Address</strong></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#step-3">	<strong>Package</strong></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#step-4">	<strong>Login Details</strong></a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content wizard-content">
                                                   <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                                            <div class="row mb-3 mt-4">
                                                                <label  class="col-sm-3 col-form-label">Sponsor</label>
                                                                <div class="col-sm-8">
                                                                    <select name="sponsor" id="sponsor" style="width:100%" class="single-select" required ></select>
                                                                    @if ($errors->has('sponsor'))
                                                                        <span class="text-danger">
                                                                        <strong>{{ $errors->first('sponsor') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                    <div class="text-info rounded">If you don't have a sponsor code, search your area or contact admin</div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Enter Your Name</label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="firstname" placeholder="Firstname" required>
                                                                    @if ($errors->has('firstname'))
                                                                        <span class="text-danger">
                                                                        <strong>{{ $errors->first('firstname') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="lastname" placeholder="Lastname" required>
                                                                    @if ($errors->has('lastname'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('lastname') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Gender</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-select" name="gender" required>
                                                                        <option value="male">Male</option>
                                                                        <option value="female">Female</option>
                                                                    </select>
                                                                    @if ($errors->has('gender'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('gender') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label  class="col-sm-3 col-form-label">Profession</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="profession"  placeholder="Profession">
                                                                    @if ($errors->has('profession'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('profession') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label  class="col-sm-3 col-form-label">Phone Number</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="phone"  placeholder="Phone" required>
                                                                    @if ($errors->has('phone'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                   <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                                            <div class="row mb-3 mt-4">
                                                                <label  class="col-sm-3 col-form-label">Address</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="address" required>
                                                                    @if ($errors->has('address'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('address') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label  class="col-sm-3 col-form-label">Address 2</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="address2">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">City</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="city" required>
                                                                    @if ($errors->has('city'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('city') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">State</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="state" required>
                                                                    @if ($errors->has('state'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('state') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Choose Country</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-select" name="country" id="country">
                                                                        <option value="">Choose</option>
                                                                        <option selected value="Nigeria">Nigeria</option>
                                                                        @foreach($countries as $country)
                                                                            <option value="{{$country->name}}">{{$country->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('country'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('country') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                   <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Choose Package</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-select" name="package">
                                                                        @foreach($packages as $package)
                                                                            <option value="{{$package->id}}">
                                                                                {{$package->name}}, &nbsp;&nbsp; {{$package->priceDefault[0]->currency_code}} {{$package->priceDefault[0]->price}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('package'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('package') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Payment Option</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-select" name="payment" id="payment">
                                                                        <option value="epin">E-Pin</option>
                                                                        <option value="bank">Bank Transfer</option>
                                                                    </select>
                                                                    @if ($errors->has('payment'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('payment') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3" id="epin">
                                                                <label class="col-sm-3 col-form-label">Epin</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="epin">
                                                                    @if ($errors->has('epin'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('epin') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                           <div class="row mb-3 hide" id="bank">
                                                               <label class="col-sm-3 col-form-label">Bank Details</label>
                                                               <div class="col-sm-8">
                                                                   <h4>  You are to pay with the account number bellow</h4>
                                                                   <p><b>GREAT PROVIDER GLOBAL NETWORK LTD<br> ACCOUNT NUMBER: 1015380345<br> ACCOUNT TYPE : CURRENT<br>
                                                                           BANK: ZENITH BANK PLC
                                                                       </b></p>
                                                               </div>
                                                           </div>

                                                        </div>
                                                   <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                                            <div class="row mb-3">
                                                                <label  class="col-sm-3 col-form-label">Username</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="username" required>
                                                                    @if ($errors->has('username'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('username') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label  class="col-sm-3 col-form-label">Email Address</label>
                                                                <div class="col-sm-8">
                                                                    <input type="email" class="form-control" name="email"  placeholder="Email Address" required>
                                                                    @if ($errors->has('email'))
                                                                        <span class="text-danger">
                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Choose Password</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group" id="show_hide_password">
                                                                        <input type="password" name="password" class="form-control border-end-0" value="" placeholder="Enter Password" required>
                                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                                        @if ($errors->has('password'))
                                                                            <span class="text-danger">
                                                                                <strong>{{ $errors->first('password') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label">Confirm Password</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group" id="show_hide_password">
                                                                        <input type="password" name="password_confirmation" class="form-control border-end-0" placeholder="Retype Password" required>
                                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                                        @if ($errors->has('password_confirmation'))
                                                                            <span class="text-danger">
                                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3 mt-5">
                                                                <div class="col-sm-8">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="terms">
                                                                        <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="d-grid">
                                                                    <button type="submit" class="btn btn-primary" onclick="submitForm()"><i class='bx bx-user'></i>Sign up</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->

                <!-- modal-lg
                <div class="modal fade" id="bankModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Large modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                        </div>
                    </div>
                </div>
                -->

                <!-- Terms and Conditions ->
                <div class="modal fade in" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="Terms and conditions" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Terms and conditions</h3>
                            </div>
                            <div class="modal-body">
                                <p>
                                    All rights reserved. No part of this site may be reproduced, stored in a retrieval system,
                                    or transmitted in any form or by any means, without the prior written permission of the developer's.</p>

                                <h5><b>Terms of Use</b></h5>
                                <p> These Terms and Conditions ("Terms", "Terms and Conditions") govern your relationship with https://www.getproskills.com website (the "Service") operated by GPS ("us", "we", or "our").
                                    Please read these Terms and Conditions carefully before using the Service.
                                    Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.
                                    By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service.</p><p>
                                </p><h5><b>GPS services</b></h5>
                                <p>GPS operates as in intermediate service by providing gateway for users to refer other persons/users into the platform and get rewarded with bonuses and incentives for completing any of the stage/level on it website. We will do our best to provide stable, secure and feature full service, however we do not take responsibility for any funds loss.
                                    GPS is still in development, therefore some bugs or other issues may arise. We will work hard to fix any issues as soon as possible, add new features and overall improve our service.
                                    GPS reserves the right to seize any funds of suspicious illegal activity such as mining/unauthorised transactions with botnets, money laundering, hacking attempts, etc. </p><p>
                                </p><h5><b>PURCHASE PACKAGES</b></h5>
                                <p>If you wish to purchase any product or service made available through the Service ("Purchase"), you may be asked to supply certain information relevant to your Purchase including, without limitation, your credit card number, the expiration date of your credit card, your billing address, and your shipping information.
                                    You represent and warrant that: (i) you have the legal right to use any credit card(s) or other payment method(s) in connection with any Purchase; and that (ii) the information you supply to us is true, correct and complete.
                                    By submitting such information, you grant us the right to provide the information to third parties for purposes of facilitating the completion of Purchases.
                                    We reserve the right to refuse or cancel your order at any time for certain reasons including but not limited to: product or service availability, errors in the description or price of the product or service, error in your order or other reasons.
                                    We reserve the right to refuse or cancel your order if fraud or an unauthorised or illegal transaction is suspected.</p><p>
                                </p><h4><b>REFUND POLICY </b></h4>
                                <p>If you wish to purchase any of our product or service, please bear in mind that this site reward users for every purchase of pin/pins made by those there refer to this site, there by we will not refund money paid to us once pin is generated and registration has been or is about to be made. be sure of your decision before  joining this site .</p>

                                <h4><b>EARNING POLICY </b></h4>
                                <p>GPS is entirely governed by the principle of online network marketing, and all users are entile to earn bonuses by their involvement in the process of developing their tree/network or matrix. GPS is an online network marketing business which has set aside a structure to reward all it memebers who have met the conditions. to earn (i) You must refer a minimum of two users. (ii) You must have a complete matrix .(iii) You must be of that level to earn from it. for more on how to earn refer to our compensation plan:<a> https://www.getproskills.com/compensation</a> </p>
                                <h5><b>Availability, Errors and Inaccuracies</b></h5>
                                <p>We are constantly updating our offerings of products and services on the Site. The products or services available on our Service may be mispriced, described inaccurately, or unavailable, and we may experience delays in updating information on the Service and in our advertising on other web sites.
                                    We cannot and do not guarantee the accuracy or completeness of any information, including prices, product images, specifications, availability, and services. We reserve the right to change or update information and to correct errors, inaccuracies, or omissions at any time without prior notice</p>.
                                <h5><b>Contests, Sweepstakes and Promotions</b></h5>
                                <p>Any contests, sweepstakes or other promotions (collectively, "Promotions") made available through the Service may be governed by rules that are separate from these Terms. If you participate in any Promotions, please review the applicable rules as well as our Privacy Policy. If the rules for a Promotion conflict with these Terms, the Promotion rules will apply.</p>
                                <h5><b>Accounts</b></h5>
                                <p>When you create an account with us, you must provide us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.
                                    You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.
                                    You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>
                                <h5><b>Intellectual Property</b></h5>
                                <p>The Service and its original content, features and functionality are and will remain the exclusive property of GPS and its licensors. The Service is protected by copyright, trademark, and other laws of both the Nigeria and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of GPS.</p>
                                <h5><b>Links To Other Web Sites</b></h5>
                                <p>Our Service may contain links to third-party web sites or services that are not owned or controlled by GPS.
                                    GPS has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that GPS shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.
                                    We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>
                                <h5><b>Termination</b></h5>
                                <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.
                                    Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you may simply discontinue using the Service.</p>
                                <h5><b>Limitation Of Liability</b></h5>
                                <p>In no event shall GPS, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from (i) your access to or use of or inability to access or use the Service; (ii) any conduct or content of any third party on the Service; (iii) any content obtained from the Service; and (iv) unauthorized access, use or alteration of your transmissions or content, whether based on warranty, contract, tort (including negligence) or any other legal theory, whether or not we have been informed of the possibility of such damage, and even if a remedy set forth herein is found to have failed of its essential purpose.</p>
                                <h4><b>Disclaimer</b></h4>
                                <p>Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement or course of performance.
                                    GPS its subsidiaries, affiliates, and its licensors do not warrant that a) the Service will function uninterrupted, secure or available at any particular time or location; b) any errors or defects will be corrected; c) the Service is free of viruses or other harmful components; or d) the results of using the Service will meet your requirements.</p>



                                <h5> ACCOUNT BLOCKING: </h5>
                                <p>
                                    Blocking : account may be blocked  and money loosed if users refuse to follow the ethics and rules
                                    that bind this site(GPS). the following conducts  may lead to account blockage and permanent  termination of account.
                                </p><ul>
                                    <li> Any user with actions or activities considered or is suspected to be frudulent
                                        such account will be blocked, until proper investigation is carried out.
                                    </li>
                                    <li> Any user that is not active during or within three month , such acount will be blocked without prior notice.

                                    </li>
                                    <li>User who go about with fake rumours capable of destroying the integrity and
                                        smooth running of this site (GPS) will have their account blocked without notice .
                                        any action carried out that will threaten other Users of this site ,be it threat to life,
                                        fund, nor  threat to the site owners as well , such a User will have their account blocked
                                        and will lose their entire money be it  their capital or interest. </li>
                                    <li> Users who are caught using abusive words on fellow Users or on any of GPS social media  group
                                        will have his/her GPS account blocked permanently. </li>
                                    <li>We advice you write all complains to Admin through complaint on your dashboard or on the landing page.
                                        no complaint written on any of our social media page will be attended to ,
                                        as none of the Admin
                                        will be able to handle from the social media . complaint must be communicated through support only. </li>

                                </ul>

                                <p></p>


                                <h5>ACCOUNT TRANSFER </h5>
                                <p>A member has the right to sell/ transfer his/her account to another member with whatever agreement they have.
                                    But the agreement must be communicated to the management by writing,
                                    and the account owner must give reasons for the account transfer.
                                    We advise that some percentage be given to the seller if they are work done on the account.
                                    (active users) we recommend 5% interest per an active user under the said account.</p>


                                <h5>ACCOUNT ROLL OVER</h5>
                                <p>A member account can/will be rolled over if these happens </p>
                                <ul>
                                    <li>1	a member whose up line has reported to the company to be inactive.
                                        Creating whatever is regarded as issues in the team, quarrelling, fighting,
                                        discouraging other peace loving members etc.</li>
                                    <li>2	a member whose account has been dormant for eight (8) to twelve (12) weeks under an active leader. And the member is not promoting and has not written to the company informing the management of the reasons to which his/her account is not active, such account will be rolled over and giving to the up line in the said matrix who is active.
                                        We need the growth of all and we are doing this to support and not to make anyone a slave to the other.</li>
                                </ul><p></p>

                                <h5><b>Governing Law</b></h5>
                                <p>These Terms shall be governed and construed in accordance with the laws of Nigeria, without regard to its conflict of law provisions.
                                    Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>
                                <h5><b>Changes</b></h5>
                                <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 15 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.
                                    By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>
                                <h5><b>Contact Us</b></h5>
                                <p>If you have any questions about these Terms, please contact us.<a> mygpssuport@gmail.com</a></p>


                                <p>
                                    Every effort has been made in the development of this site to ensure the accuracy of the information presented.

                                    However, the information contained in this site is without warranty,
                                    either express or implied. Neither the site owner, nor users ,
                                    and its distributors will be held liable for any damages caused or alleged to be caused directly or indirectly by this site.
                                </p>

                                <h5> Warranty/Guarantee: </h5>

                                <p>
                                    please note, be very sure of your decision before you make any donation. the site
                                    owners will not answer any question whatsoever if you lose your money as a result of your
                                    participation on this site. keep your security details intact and make
                                    sure you operate without pressure from anyone.
                                </p>
                                <p>
                                    GPS is not giving warranty that all user must be paid after/within any promotional period or thereafter . we only made payment is every Friday and we reserve the right to change our pay days as the need arises.
                                    Every promotional package come with it terms and condition. your success in the use of our service is based on the compliance of our terms of service.
                                    please note that GPS is not An investment Platform.
                                    GPS is not a quick money making site , to become successful you must follow the ethics of the site.
                                    we do not take responsibilities of your success on this site . the decision is yours to make.
                                    please note that your registration do not guarantee that (i) you must get all the reward stated here. (ii ) you must get all the incentive without following the conditions of the site.
                                    please be free to write to us <a>mygpssuport@gmail.com</a>
                                </p></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>

                <-- Account details ->
                <div class="modal fade" id="bankModal2" tabindex="-1" role="dialog" aria-labelledby="Company Account" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Company Account Number </h3>
                            </div>

                            <div class="modal-body">
                                <h4>  You are to pay with the account number bellow</h4>
                                <p><b>GREAT PROVIDER GLOBAL NETWORK LTD<br> ACCOUNT NUMBER: 1015380345<br> ACCOUNT TYPE : CURRENT<br>
                                        BANK: ZENITH BANK PLC
                                    </b></p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
                -->



            </div>
        </div>
    </div>
    <!--end wrapper-->




    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!--app JS-->
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <!--Password show & hide js -->
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#smartwizard').smartWizard({
                theme: 'arrows',
                transition: {
                    animation: 'slide-horizontal',
                },
            }).on("leaveStep", function(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {

                if((stepDirection =="forward") && (currentStepIndex ==0)){
                    if(!$('#sponsor').val()){
                        alert("Sponsor required");
                        return false;
                    }
                    if(!$("input[name=firstname]").val()){
                        alert("firstname required");
                        return false;
                    }
                    if(!$("input[name=lastname]").val()){
                        alert("Lastname required");
                        return false;
                    }
                    if(!$("input[name=phone]").val()){
                        alert("Phone Number required");
                        return false;
                    }

                }else if((stepDirection =="forward") && (currentStepIndex ==1)){
                    if(!$('#country').val()){
                        alert("country required");
                        return false;
                    }
                    if(!$("input[name=state]").val()){
                        alert("state required");
                        return false;
                    }
                    if(!$("input[name=address]").val()){
                        alert("address required");
                        return false;
                    }

                }else{
                }
            });
        });

        $('#payment').on('change', function () {
            $("#bank").removeClass("hide");
            $("#epin").removeClass("hide");

            $("#bank").removeClass("show");
            $("#epin").removeClass("show");
            if(this.value=="bank"){
               $("#bank").addClass('show');
               $("#epin").addClass('hide');
            }else if(this.value=="epin"){
                $("#epin").addClass('show');
                $("#bank").addClass('hide');
            }
        })

        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            minimumInputLength: 3,
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
            ajax: {
                delay: 250,
                url: "{{ url('/members/lookup/terms') }}",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                    }
                    return query;
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        function submitForm(){
            //alert("submit Form clicked")
        }
    </script>


    </body>
@endsection
