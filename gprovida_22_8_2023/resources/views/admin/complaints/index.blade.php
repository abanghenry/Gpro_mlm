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
                    <li><a href="{{ url('admin/bitcoin') }}">Complaints</a></li>
                </ol>

                <h1>Support Tickets</h1>

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
                                <h4>Complaints</h4>
                                <div class="options">

                                </div>
                            </div>
                            <div class="panel-body">
                              <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped  datatables" id="example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username/phone</th>
                                        <th>User</th>
                                      
                                        <th>subject</th>
                                        <th>message</th>
                                        <th>status</th>
                                        <th>urgency</th>
                                        <th>last_reply</th>
                                        <th>created_at</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($complaints as $complaint)
                                        <tr >
                                            <td>{{ $complaint->ticket_id }}</td>
                                            <td>{{ $complaint->user->username }}  {{ $complaint->user->phone }}</td>
                                            <td> {{ $complaint->user->firstname }} {{ $complaint->user->lastname }}</td>
                                            <td>{{ $complaint->subject }}</td>
                                            <td>{{ $complaint->message }}</td>
                                            <td>
                                                {{ $complaint->status->name }}
                                            </td>
                                            <td>{{ $complaint->urgency }}</td>
                                            <td>{{ $complaint->last_reply }}</td>
                                            <td>{{ $complaint->created_date }}</td>
                                            <td>
                                                <a  class="btn btn-primary btn-xs" href="{{ url('admin/complaint')}}/{{$complaint->id}}">View</a>
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
