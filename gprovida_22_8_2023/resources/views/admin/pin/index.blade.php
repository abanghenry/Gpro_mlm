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

                                <div class="pull-right" style="margin-bottom: 20px">
                                    <a href="{{ url('admin/pin/create') }}" class="btn btn-primary">Create New Pin</a>
                                </div>
                                <div class="clearfix"></div>

                                <table class="table table-bordered table-hover table-striped datatables" id="example">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pin Number</th>
                                        <th>Package Name</th>
                                        <th>Owner </th>
                                        <th>Status</th>
                                        <th>Used for</th>
                                        <th>Created</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($pins as $pin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pin->pin_number }}</td>
                                            <td>{{ $pin->package_name }}</td>
                                            <td>{{ $pin->owner?->username }}
                                                {{ $pin->owner?->firstname }} {{ $pin->owner?->lastname }}
                                            </td>
                                            <td>
                                                @if ($pin->status == 0)
                                                    <span class="label label-success">Unused</span>
                                                @elseif($pin->status == 1)
                                                     <span class="label label-info">Used</span>
                                                @elseif($pin->status == 2)
                                                    <span class="label label-danger">cancelled</span>
                                                @else
                                                    {{$pin->status}}
                                                @endif
                                            </td>
                                            <td>{{ $pin->user?->username }}</td>

                                            <td>{{ $pin->created_at }}</td>

                                            <td>
                                                <a href="{{ url('admin/pin/'.$pin->id.'/edit/') }}">
                                                    <img src="/adminTemplate/img/edit.gif" alt="Edit" width="16" height="16" border="0">
                                                </a>

                                            </td>

                                            <td>

                                                {{ Form::open(array('url' => 'admin/pin/' . $pin->id, 'class' => ' ',
                                                        'onsubmit' => 'return ConfirmDelete()')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {!! Form::button('<i class="fa fa-trash-o"></i>',
                                                    array('type' => 'submit', 'class' => 'btn btn-danger btn-xs')) !!}
                                                {{ Form::close() }}

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
