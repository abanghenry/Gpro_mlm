@extends('admin/AdminLayouts.app')

@section('pageTitle', 'Create award')


@section('content')

    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li>Award</li>
                    <li class="active"><a href="{{ url('admin/award') }}">create Award</a> </li>
                </ol>
                <h1>Award</h1>
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
                                <h4>Create Award</h4>

                            </div>
                            <div class="panel-body">

                                <br>
                                <form class="form-horizontal" action="{{ url('admin/award')}}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Award Name</label>
                                        <div class="col-sm-3">
                                            <input name="name" type="text" class="form-control" value="{{old('name')}}" required>
                                            @if ($errors->has('name'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Point Value</label>
                                        <div class="col-sm-3">
                                            <input name="pv" type="number" class="form-control"  value="{{old('pv')}}" required>
                                            @if ($errors->has('pv'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('pv') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label">Cash Equivalent</label>
                                        <div class="col-sm-3">
                                            <input name="cash_equivalent" type="number" class="form-control" value="{{old('cash_equivalent')}}" required>
                                            @if ($errors->has('cash_equivalent'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('cash_equivalent') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                <br/><br/>


                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <div class="btn-toolbar">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-4">
                                                            <button type="submit" class="btn btn-primary"> Save</button>
                                                            &nbsp;&nbsp;
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


@section('styles')
    <style>
        .help-block {
            display: block;
            color: #a81515 !important;
        }
    </style>

@stop

