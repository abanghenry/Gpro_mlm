@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)

@section('styles')

    <link rel='stylesheet' type='text/css' href="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.css') }}" />
    <style>
        .modal-dialog-centered{
            margin-top: 190px
        }

        .product-thumbnail{
            width: 40px;
            height: 40px;
            overflow: hidden;
        }

    </style>
@stop



@section('content')

    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li class="active">Pin</li>
                </ol>

                <h1>{{$pageTitle}}</h1>

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
                    <div class="col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4>{{$pageTitle}}</h4>
                                <div class="options">

                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="clearfix"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped datatables" id="example">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Package Name</th>
                                            <th>Quantity</th>
                                            <th>Amount Paid</th>
                                            <th>Payment Mode</th>
                                            <th>Account Details</th>
                                            <th>Payment Details</th>
                                            <th>view teller</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>view</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($pin_requests as $pin_request)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pin_request->user?->firstname }}{{ $pin_request->user?->lastname }}
                                                    ({{ $pin_request->user?->username }})
                                                </td>
                                                <td>{{ $pin_request->package?->name }}</td>
                                                <td>{{ $pin_request->quantity }}</td>
                                                <td>{{ $pin_request->currency->prefix }}{{ number_format($pin_request->amount_paid,2)  }}</td>
                                                <td>{{ $pin_request->payment_mode }}</td>
                                                <td>
                                                    {{ $pin_request->bank }}<br/>
                                                    {{ $pin_request->account_number}}
                                                </td>
                                                <td>{{ $pin_request->payment_details }}</td>
                                                <td>
                                                    <a href="{{ url($pin_request->transaction_teller) }}">
                                                        <i class="fa fa-file-image-o"></i>
                                                    </a>
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
                                                    @if ($pin_request->status == "pending")
                                                        <a href="{{ url('admin/pinrequest/'.$pin_request->id.'/edit/') }}">
                                                            <img src="/adminTemplate/img/edit.gif" alt="Edit" width="16" height="16" border="0">
                                                        </a>
                                                    @endif


                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>









            </div> <!-- container -->
        </div> <!--wrap -->
    </div>
@endsection



@section('scripts')
    <script src="{{ URL::asset('adminTemplate/plugins/datatables/jquery.dataTables.min.js')    }}"></script>
    <script src="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('adminTemplate/plugins/form-jasnyupload/fileinput.js') }}"></script>




    <script>

        // -------------------------------
        // Initialize Data Tables
        // -------------------------------

        $(document).ready(function() {
            $('.datatables').dataTable({
                "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page",
                    "sSearch": ""
                }
            });
            $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search...');
            $('.dataTables_length select').addClass('form-control');
        });


        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

    </script>



@stop
