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
                    <li class="active">Users</li>
                </ol>

                <h1>Users</h1>

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
                    <div class="col-md-3">
                        <a class="info-tiles tiles-success" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">Total users</div>
                                <div class="pull-right"></div>
                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-group"></i></div>
                                <div class="pull-right">{{ number_format($totalMembers) }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tiles tiles-orange" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">Active Members</div>
                                <div class="pull-right">{{ number_format(($totalMembersActive/$totalMembers)*100) }}%  </div>
                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-group"></i></div>
                                <div class="pull-right">{{ number_format($totalMembersActive) }} </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tiles tiles-brown" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">Deleted Members</div>
                                <div class="pull-right">{{ number_format(($totalMembersDeleted/$totalMembers)*100) }}% </div>
                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-group"></i></div>
                                <div class="pull-right">{{ number_format($totalMembersDeleted) }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tiles tiles-midnightblue" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">Stockist</div>
                                <div class="pull-right">{{ number_format(($stockistUsers/$totalMembers)*100) }}% </div>
                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-group"></i></div>
                                <div class="pull-right">{{ number_format($stockistUsers) }}</div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4>Package</h4>
                                <div class="options">

                                </div>
                            </div>
                            <div class="panel-body">
                              <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped  datatables" id="example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>firstname</th>
                                        <th>lastname</th>
                                        <th>email</th>
                                        <th>phone</th>
                                        <th>Activated</th>
                                        <th>Online*</th>
                                        <th>Roles</th>
                                        <th>Member Since</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $user)
                                            <tr  class="{{ $user->deleted_at? ' deleted-row' : '' }}">
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->firstname }}</td>
                                                <td>{{ $user->lastname }} </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>

                                                <td>
                                                    @if($user->active == 1 )
                                                        <img src="/adminTemplate/img/tick.png">
                                                    @else
                                                        <img src="/adminTemplate/img/cross.png">
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($user->session?->last_activity >= (time() - 2400) )
                                                        <span class="label label-success">Online</span>
                                                    @else
                                                        <span class="label label-danger">Offline</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->type == 5)
                                                        <span class="label label-success">Admin</span>
                                                    @elseif($user->type ==3)
                                                        <span class="label label-info">Stockist</span>
                                                    @else
                                                        <span class="label label-warning">User</span>
                                                @endif
                                                </td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>
                                                    <a  class="btn btn-primary btn-xs" href="{{ url('admin/members')}}/{{$user->id}}">View</a>
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
