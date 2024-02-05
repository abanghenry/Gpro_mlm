@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)

@section('styles')

@stop



@section('content')
    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin/members') }}">Members</a></li>
                    <li class="active"><a href="#">Member Management</a> </li>
                </ol>

                <h1>{{$user->firstname}} {{$user->lastname}}  ({{$user->username}})</h1>

            </div>



            <div class="container">

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


                    <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-sky">
                            <div class="panel-heading">
                                <h4>Member Details</h4>
                                <div class="options">
                                    <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                                </div>
                            </div>
                            <div class="panel-body collapse in">
                                <!--  Userss -->
                                <br/>

                                <table class="table table-bordered table-condensed">
                                    <tr>
                                        <td><b>Username</b></td><td><b>Name</b></td><td ><b>Email</b></td>
                                    </tr>
                                    <tr>
                                        <td>{{$user->username}}</td>
                                        <td>
                                            {{$user->lastname}}
                                            {{$user->firstname}}
                                        </td>

                                        <td width="40%">
                                            @if($user->type==5)
                                                {{$user->email}}
                                            @else
                                                <form action="{{ url('admin/members') }}/{{$user->id}}/updateemail" method="post"
                                                      name="updateUserEmailForm" id="updateUserEmailForm" class="form-horizontal" >
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="userID" id="userID"  value="{{$user->id}}">
                                                    <input type="hidden" name="task"  id="task" value="updateemail">
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <div class="col-sm-11">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="email"  id="email" value="{{$user->email}}">
                                                                <div class="input-group-btn">
                                                                    <button type="button" onclick="updateUser()" class="btn btn-midnightblue">Update User email</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>

                                    </tr>

                                    <tr>
                                        <td><b>Type</b></td><td><strong>Registration</strong></td><td><b>Activation Date</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if($user->type==5)
                                                <span class="label label-success">Admin</span>
                                            @elseif($user->type==3)
                                                <span class="label label-success">Stockist</span>
                                            @else
                                                <span class="label label-success">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$user->created_at}}
                                        </td>
                                        <td> {{$user->date_activated}}</td>
                                    </tr>


                                    <tr>
                                        <td><b>Package</b></td>
                                        <td><b>Payment Method</b></td>
                                        <td><b>Currency</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$user->package->name}}
                                        </td>
                                        <td>
                                            {{$user->payment_method}}
                                        </td>
                                        <td>
                                            {{$user->currency->name}} ( {{$user->currency->prefix}} )
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="3"> &nbsp</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><b>Address</b> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" >{{$user->address}}, <br/> {{$user->address2}}  <br/><br/>
                                    </tr>
                                    <tr>
                                        <td><b>Country</b></td>
                                        <td><strong>State</strong></td>
                                        <td><b>City</b></td>
                                    </tr>
                                    <tr>
                                        <td>{{$user->country}}</td>
                                        <td>{{$user->state}}</td>
                                        <td>{{$user->city}} </td>
                                    </tr>

                                    <tr><td><b>phone</b></td><td><strong>verified</strong></td><td><b>business_name</b></td></tr>
                                    <tr>
                                          <td>{{$user->phone}}</td><td>
                                              @if($user->verified==1)
                                                  <img src="/adminTemplate/img/tick.png">
                                              @else
                                                  <img src="/adminTemplate/img/cross.png">
                                              @endif
                                          </td> <td>{{$user->business_name}} </td>
                                      </tr>




                                    <tr><td colspan="3"> &nbsp</td></tr>

                                    <tr><td colspan="3"><b>Transactions</b></td></tr>
                                    <tr>
                                        <td><b style="color: green">Shipped</b></td>
                                        <td><b style="color: #4f8edc">Processing</b></td>
                                        <td><b style="color: #f1c40f;">Pending</b></td>

                                    </tr>
                                    <tr><td>{{$transactionsGroup['shipped']}}</td>
                                        <td>{{$transactionsGroup['processing']}}</td>
                                        <td>{{$transactionsGroup['pending']}}</td>
                                    </tr>
                                    <tr><td><b style="color: #f1c40f">Cancelled</b></td>
                                        <td><b style="color: #2bbce0">Refund</b></td>
                                        <td><b style="color: #e73c3c;">Fraud</b></td>
                                    </tr>

                                    <tr>
                                        <td>{{$transactionsGroup['cancelled']}}</td>
                                        <td>{{$transactionsGroup['refund']}}</td>
                                        <td>{{$transactionsGroup['fraud']}}</td>
                                    </tr>
                                    <tr><td colspan="3">&nbsp</td></tr>
                                    <tr><td colspan="3"><b>Downline</b></td></tr>
                                    <tr><td colspan="3">&nbsp</td></tr>
                                    <tr><td colspan="3"><b>Login History (last 10)</b></td></tr>
                                    <tr><td><b>Date</b></td><td><b>Ip Address</b></td><td><b>Action</b></td></tr>
                                    @foreach($logins  as $login)
                                        <tr>
                                            <td>{{$login->login_date}}</td>
                                            <td>{{$login->ip_address}}</td>
                                            <td>{{$login->action}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3">&nbsp</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <form action="{{ url('admin/members') }}/{{$user->id}}" method="POST"
                                                  name="deleteUserForm" id="deleteUserForm" >
                                                {{ csrf_field() }}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input type="hidden" name="userID" id="userID"  value="{{$user->id}}">
                                                <input type="hidden" name="task"  id="task" value="">
                                                <div class="btn-container">
                                                    <input  value="Delete this User" onclick="deleteUser()" class="btn btn-danger" type="button">
                                                </div>

                                            </form>
                                        </td>
                                        <td>
                                            @if($user->active==0)
                                            <form action="{{ url('admin/members') }}/{{$user->id}}/activate" method="post"
                                                  name="activateUserForm" id="activateUserForm" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="userID" id="userID"  value="{{$user->id}}">
                                                <input type="hidden" name="task"  id="task" value="">
                                                <div class="btn-container">
                                                    <input  value="Activate this User" onclick="activateUser()" class="btn btn-success" type="button">
                                                </div>
                                            </form>
                                            @else
                                             Active User
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ url('admin/members') }}/{{$user->id}}/impersonate" method="post"
                                                   name="impersonateUserForm" id="impersonateUserForm" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="userID" id="userID"  value="{{$user->id}}">
                                                <input type="hidden" name="task"  id="task" value="">
                                                <div class="btn-container">
                                                    <input  value="Impersonate User" onclick="impersonateUser()" class="btn btn-info" type="button">
                                                </div>

                                            </form>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Fund Wallet</td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Current Amount: {{$user->currency->prefix}} {{ number_format($user->wallet,2) }}
                                        </td>
                                        <td colspan="2">
                                            <form action="{{ url('admin/members') }}/{{$user->id}}/fundwallet" method="post"
                                                  name="fundUserForm" id="fundUserForm" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="userID" id="userID"  value="{{$user->id}}">
                                                <input type="hidden" name="task"  id="task" value="fundwallet">
                                                <div class="btn-container">
                                                    <input  value="Fund Wallet" onclick="fundwalletUser()" class="btn btn-success" type="button">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="number" name="amount"  id="amount" value="" placeholder="Enter Amount">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </table>




                            </div>
                        </div>
                    </div>
                </div>










            </div> <!-- container -->
        </div> <!--wrap -->
    </div> <!-- page-content -->
@endsection





@section('scripts')

    <script type="text/javascript">

        var formDelete = document.deleteUserForm;
        var formActivate = document.activateUserForm;
        var formImpersonate = document.impersonateUserForm;
        var formFundUser = document.fundUserForm;
        var formUpdateUserEmail = document.updateUserEmailForm;

        function deleteUser(){
            if (confirm("Are you sure you want to delete this User?")){
                formDelete.task.value='delete';
                formDelete.submit();
            }
        }

        function impersonateUser(){
            formImpersonate.task.value='impersonate';
            formImpersonate.submit();
        }

        function activateUser(){
            if (confirm("Are you sure you want to active this User?")){
                formActivate.task.value='activate';
                formActivate.submit();
            }
        }

        function fundwalletUser(){
            if (confirm("Are you sure you want to Fund this User's Wallet?")){
                formFundUser.task.value='fundwallet';
                formFundUser.submit();
            }
        }

        function updateUser(){
            if (confirm("Are you sure you want to Update this User's Email?")){
                formUpdateUserEmail.task.value='updateemail';
                formUpdateUserEmail.submit();
            }
        }




    </script>


@stop
