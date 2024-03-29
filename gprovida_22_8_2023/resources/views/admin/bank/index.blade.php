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
                    <li><a href="{{ url('admin/banks') }}">Bank</a></li>
                </ol>

                <h1>Users Bank Accounts</h1>

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
                                <h4>Bank Accounts</h4>
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
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                        <th>Country</th>
                                        <th>Type</th>
                                        <th>Default</th>
                                        <th>Currency</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($banks as $bank)
                                        <tr  class="{{ $bank->deleted_at? ' deleted-row' : '' }}">
                                            <td>{{ $bank->id }}</td>
                                            <td>{{ $bank->user?->firstname }} {{ $bank->user?->lastname }}</td>
                                            <td>{{ $bank->bank_name }}</td>
                                            <td>{{ $bank->bank_holder_name }} </td>
                                            <td>{{ $bank->bank_account_number }}</td>
                                            <td>{{ $bank->country }}</td>
                                            <td>{{ $bank->type }}</td>

                                            <td>
                                                @if($bank->default == 1 )
                                                    <span class="label label-success">Defualt</span>
                                                @endif
                                            </td>
                                            <td>{{ $bank->currency?->code }}</td>
                                            <td>{{ $bank->created_date }}</td>
                                            <td>
                                                <a  class="btn btn-primary btn-xs" href="{{ url('admin/banks')}}/{{$bank->id}}">View</a>
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
