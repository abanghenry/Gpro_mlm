@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)

@section('styles')

@stop



@section('content')
    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin/pinrequest') }}">Pin Request</a></li>
                    <li class="active"><a href="#">Process Pin Request</a> </li>
                </ol>

                <h1>{{$pin_request->user->firstname}} {{$pin_request->user->lastname}}  ({{$pin_request->user->username}})</h1>

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
                                <h4>Request Details</h4>
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
                                        <td>{{$pin_request->user->username}}</td>
                                        <td>
                                            {{$pin_request->user->lastname}}
                                            {{$pin_request->user->firstname}}
                                        </td>
                                        <td>{{$pin_request->user->email}}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Package Name</b></td>
                                        <td><b>Quantity</b></td>
                                        <td><b>Amount Paid</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$pin_request->package?->name}}
                                        </td>

                                        <td>
                                            {{$pin_request->quantity}}
                                        </td>
                                        <td>{{ $pin_request->currency->prefix }}{{ number_format($pin_request->amount_paid,2)  }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp</td>
                                    </tr>
                                    <tr>
                                        <td><b>Payment Mode</b></td>
                                        <td><b>Account Details </b></td>
                                        <td><b>Payment Details</b></td>
                                    </tr>
                                    <tr>
                                        <td>{{ $pin_request->payment_mode }}</td>
                                        <td>
                                            {{ $pin_request->bank }}<br/>
                                            {{ $pin_request->account_number}}
                                        </td>
                                        <td>{{ $pin_request->payment_details }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td><b>Request Date </b></td>
                                        <td><b>Teller</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if ($pin_request->status == "pending")
                                                <span class="label label-warning">pending</span>
                                            @elseif($pin_request->status == "approved")
                                                <span class="label label-success">approved</span>
                                            @elseif($pin_request->status == "cancelled")
                                                <span class="label label-danger">cancelled</span>
                                            @else
                                                {{$pin_request->status}}
                                            @endif
                                        </td>
                                        <td>{{ $pin_request->CreatedDate }}</td>
                                        <td>
                                            <a href="{{ url($pin_request->transaction_teller) }}">
                                                <i class="fa fa-file-image-o"></i>
                                            </a>
                                        <td>
                                    </tr>


                                    <tr>
                                        <td colspan="3">&nbsp</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if($pin_request->status=="pending")
                                                <form action="{{ url('admin/pinrequest') }}/{{$pin_request->id}}" method="post"
                                                      name="approveRequestForm" id="approveRequestForm" >
                                                    {{ csrf_field() }}
                                                    <input name="_method" type="hidden" value="PUT">
                                                    <input type="hidden" name="pinRequestID" id="pinRequestID"  value="{{$pin_request->id}}">
                                                    <input type="hidden" name="task"  id="task" value="approve">
                                                    <div class="btn-container">
                                                        <input  value="Approve this request" onclick="approveRequest()" class="btn btn-success" type="button">
                                                    </div>
                                                </form>
                                            @else
                                                Processed Request
                                            @endif
                                        </td>
                                        <td>
                                            @if($pin_request->status=="pending")
                                                <form action="{{ url('admin/pinrequest') }}/{{$pin_request->id}}" method="POST"
                                                  name="cancelRequestForm" id="cancelRequestForm" >
                                                {{ csrf_field() }}
                                                <input name="_method" type="hidden" value="PUT">
                                                <input type="hidden" name="pinRequestID" id="pinRequestID"  value="{{$pin_request->id}}">
                                                <input type="hidden" name="task"  id="task" value="cancel">
                                                <div class="btn-container">
                                                    <input  value="Cancel Request" onclick="cancelRequest()" class="btn btn-danger" type="button">
                                                </div>

                                            </form>
                                            @else
                                                Processed Request
                                            @endif
                                        </td>

                                        <td>

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

        var formApprove = document.approveRequestForm;
        var formCancel = document.cancelRequestForm;


        function approveRequest(){
            if (confirm("Are you sure you want to Approve this request?, It will create  {{$pin_request->quantity}} Pins for {{$pin_request->user->username}}")){
                formApprove.task.value='approve';
                formApprove.submit();
            }
        }

        function cancelRequest(){
            if (confirm("Are you sure you want to Cancel  this Pin request?")){
                formCancel.task.value='cancel';
                formCancel.submit();
            }
        }


    </script>


@stop
