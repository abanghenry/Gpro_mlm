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

        .deleted-row {
            text-decoration: line-through;
            background-color: red;
        }

    </style>
@stop



@section('content')

    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin/payment') }}">Payment</a></li>
                </ol>

                <h1>Payments</h1>

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
                                <h4>Payment</h4>
                                <div class="options">

                                </div>
                            </div>
                            <div class="panel-body">

                                <form class="form-horizontal" action="{{ url('admin/payment') }}"  method="POST"  >
                                    {{ csrf_field() }}

                                    <button type="submit" class="btn btn-success" name="zenith">Pay Selected List (Zenith)</button>
                                    <button type="submit" class="btn btn-success" name="uba">Pay Selected List (UBA)</button>
                                    <br/> <br/>

                                    <table class="table table-bordered table-hover table-striped  datatables" id="example">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" name="toggle" value="" id="selectAll" /></th>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>Details</th>
                                        <th>Bank</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Payment Due Date</th>
                                        <th>Date Paid</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>
                                                @if($payment->status == "pending")
                                                    <input type="checkbox" id="cb0" name="cid[]" value="{{$payment->id}}" class="checkbox_list" />
                                                @endif
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payment->user?->firstname }} {{ $payment->user?->lastname }}</td>
                                            <td>{{ $payment->currency?->prefix}}{{ $payment->amount }} </td>
                                            <td>{{ $payment->description }}</td>
                                            <td>
                                                @if($payment->user?->bank && count($payment->user->bank)>0)
                                                    <span>Bank: <b>{{ $payment->user?->bank[0]?->bank_name }}</b> </span> <br/>
                                                    <span>Account No:  <b>{{ $payment->user?->bank[0]?->bank_account_number }}</b></span> <br/>
                                                    <span>Sort Code:  <b>{{ $payment->user?->bank[0]?->sort_code }}</b></span>
                                                @else

                                                @endif
                                            </td>
                                            <td>
                                                @if($payment->status == "pending")
                                                    <span class="label label-warning">pending</span>
                                                @elseif($payment->status =="paid")
                                                    <span class="label label-success">paid</span>
                                                @elseif($payment->status =="3")
                                                    <span class="label label-danger">flushed</span>
                                                @elseif($payment->status =="4")
                                                    <span class="label label-danger">carry forward</span>
                                                @else
                                                    <span class="label label-warning">{{ $payment->status  }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $payment->bonus_type }}</td>
                                            <td>{{ $payment->due_date }}</td>
                                            <td>{{ $payment->date_time_paid }}</td>
                                            <td>
                                                <a  class="btn btn-primary btn-xs" href="{{ url('admin/payment')}}/{{$payment->id}}">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

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

        $('#selectAll').click(function(e) {
            if($(this).hasClass('checkedAll')) {
                $('input').prop('checked', false);
                $(this).removeClass('checkedAll');
            } else {
                $('input').prop('checked', true);
                $(this).addClass('checkedAll');
            }
        });



    </script>



@stop
