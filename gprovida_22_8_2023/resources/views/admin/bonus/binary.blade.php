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
                    <li><a href="{{ url('admin/bonus/binary') }}">Bonus Binary</a></li>
                </ol>

                <h1>Binary Bonus</h1>

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
                                <h4>Binary Bonus</h4>
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
                                        <th>PV</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Source</th>
                                        <th>Date Earned</th>
                                        <th>Date Paid</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($bonusBinaries as $bonus)
                                        <tr>
                                            <td>{{  $loop->iteration }}</td>
                                            <td>{{ $bonus->user->firstname }} {{ $bonus->user->lastname }}</td>
                                            <td>{{ $bonus->pv }} </td>
                                            <td>{{ $bonus->details }}</td>
                                            <td>
                                                @if($bonus->status == "0")
                                                    <span class="label label-warning">pending</span>
                                                @elseif($bonus->status =="1")
                                                    <span class="label label-success">processing</span>
                                                @elseif($bonus->status =="2")
                                                    <span class="label label-default">paid</span>
                                                @elseif($bonus->status =="3")
                                                    <span class="label label-danger">flushed</span>
                                                @elseif($bonus->status =="4")
                                                    <span class="label label-danger">carry forward</span>
                                                @else
                                                    <span class="label label-warning">{{ $bonus->status  }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $bonus->source }}</td>
                                            <td>{{ $bonus->date_time_earned }}</td>
                                            <td>{{ $bonus->date_time_paid }}</td>
                                            <td>
                                                <a  class="btn btn-primary btn-xs" href="{{ url('admin/bonus/binary')}}/{{$bonus->id}}">View</a>
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
