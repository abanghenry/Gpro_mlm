@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)


@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/css/datepicker3.css') }}">
@stop



@section('content')
    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="/">Dashboard</a></li>
                    <li>{{$pageTitle}}</li>
                    <li class="active"><a href="{{ url('admin/package') }}">Create Product</a> </li>
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
                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4>Generate New Pin</h4>

                            </div>
                            <div class="panel-body">

                                <br>
                                <form class="form-horizontal" action="{{ url('admin/pin')}}"  method="POST" enctype='multipart/form-data' >
                                    @csrf
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Number of pins</label>
                                        <div class="col-sm-3">
                                            <input id="pin_count" name="pin_count" value="" max="200"  type="text" class="form-control" required>
                                            @if ($errors->has('pin_count'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('pin_count') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Package </label>
                                        <div class="col-sm-3">
                                            <select class="form-control" name="package" id="package">
                                                @foreach ($packages as $package)
                                                    <option value="{{ $package->id }}">{{  $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Assign to User</label>
                                        <div class="col-sm-3">
                                            <select name="user" id="e2" style="width:100%" class="populate" ></select>
                                        </div>
                                    </div>

                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <div class="btn-toolbar">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-4">
                                                            <button type="submit" class="btn btn-primary"> Create Pin</button>
                                                            <button type="reset" class="btn btn-default"> Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>


            </div> <!-- container -->
        </div> <!--wrap -->
    </div> <!-- page-content -->
@endsection





@section('scripts')

    <script src="{{ URL::asset('adminTemplate/js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('adminTemplate/plugins/form-jasnyupload/fileinput.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $("#e2").select2({width: 'resolve',
            ajax: {
                delay: 250,
                url: "{{ url('/admin/members/lookup/terms') }}",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                    }
                    return query;
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true

            }
        });
    </script>

@stop
