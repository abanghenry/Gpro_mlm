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
                    <li><a href="{{ url('admin/bitcoin') }}">Bitcoin</a></li>
                </ol>

                <h1>Users Bitcoin Accounts</h1>

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
                                <h4>Bitcoin</h4>
                                <div class="options">

                                </div>
                            </div>
                            <div class="panel-body">

                                <table class="table table-bordered table-hover table-striped  datatables" id="example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Default</th>
                                        <th>Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($bitcoins as $bitcoin)
                                        <tr  class="{{ $bitcoin->deleted_at? ' deleted-row' : '' }}">
                                            <td>{{ $bitcoin->id }}</td>
                                            <td>{{ $bitcoin->user->firstname }} {{ $bitcoin->user->lastname }}</td>
                                            <td>{{ $bitcoin->bit_address }}</td>
                                            <td>
                                                @if($bitcoin->status == 1 )
                                                    <span class="label label-success">Active</span>
                                                @else
                                                    <span class="label label-info">Disabled</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($bitcoin->default == 1 )
                                                    <span class="label label-success">Defualt</span>
                                                @endif
                                            </td>
                                            <td>{{ $bitcoin->updated_date }}</td>
                                            <td>
                                                <a  class="btn btn-primary btn-xs" href="{{ url('admin/bitcoin')}}/{{$bitcoin->id}}">View</a>
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
