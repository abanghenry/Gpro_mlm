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
                    <li><a href="{{ url('admin/bonus/referral') }}">Bonus Referral</a></li>
                </ol>

                <h1>Referral Bonus</h1>

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


                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4>Referral Bonus</h4>
                                <div class="options">

                                </div>
                            </div>
                            <div class="panel-body">
                              <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped  datatables" id="example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>PV</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Date Earned</th>
                                        <th>Date Paid</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($referralPVs as $referral)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $referral->user->firstname }} {{ $referral->user->lastname }}</td>
                                            <td>{{ $referral->currency?->prefix }}{{ number_format($referral->amount,2) }}</td>
                                            <td>{{ $referral->pv }} </td>
                                            <td>{{ $referral->details }}</td>
                                            <td>
                                            @if($referral->status == "0")
                                                <span class="label label-warning">pending</span>
                                            @elseif($referral->status =="1")
                                                <span class="label label-success">processing</span>
                                            @elseif($referral->status =="2")
                                                <span class="label label-default">paid</span>
                                            @elseif($referral->status =="3")
                                                <span class="label label-danger">carry forward</span>
                                            @else
                                                <span class="label label-warning">{{ $referral->status  }}</span>
                                            @endif
                                            </td>

                                            <td>{{ $referral->date_time_earned }}</td>
                                            <td>{{ $referral->date_time_paid }}</td>
                                            <td>
                                                <a  class="btn btn-primary btn-xs" href="{{ url('admin/bonus/referral')}}/{{$referral->id}}">View</a>
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
