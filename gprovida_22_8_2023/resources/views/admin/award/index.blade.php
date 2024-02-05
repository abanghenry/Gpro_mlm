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
                    <li><a href="{{ url('admin/') }}">Dashboard</a></li>
                    <li class="active">Awards</li>
                </ol>

                <h1>Awards</h1>

                <div class="options">
                    <div class="btn-toolbar">
                        <a href="{{url('admin/award/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Add Incentives
                        </a>
                    </div>
                </div>

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
                                <h4>Awards</h4>
                                <div class="options">

                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped  datatables" id="example">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Point Value (PV)</th>
                                            <th>Cash Equivalent</th>
                                            <th>Last Updated</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($awards as $award)
                                                <tr>
                                                    <td>{{$loop->iteration }}</td>
                                                    <td>{{ $award->name }}</td>
                                                    <td>{{ number_format($award->pv) }}</td>
                                                    <td>{{ number_format($award->cash_equivalent) }} </td>
                                                    <td>{{ $award->updated_date }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/award/'.$award->id.'/edit/') }}">
                                                            <img src="/adminTemplate/img/edit.gif" alt="Edit" width="16" height="16" border="0">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ Form::open(array('url' => 'admin/award/' . $award->id, 'class' => ' ',
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
