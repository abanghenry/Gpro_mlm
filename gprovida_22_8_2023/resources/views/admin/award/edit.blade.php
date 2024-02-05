@extends('admin/AdminLayouts.app')

@section('pageTitle', 'Currency')


@section('content')

    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li>Award</li>
                    <li class="active"><a href="{{ url('admin/award') }}">Award</a> </li>
                </ol>

                <h1>Edit Award</h1>

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
                                <h4>Edit Award</h4>

                            </div>
                            <div class="panel-body">

                                <br>
                                <form class="form-horizontal" action="{{ url('admin/award')}}/{{$award->id}}"  method="POST"  >
                                    @csrf
                                    <input name="_method" type="hidden" value="PUT">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Award Name</label>
                                        <div class="col-sm-3">
                                            <input name="name" type="text" required class="form-control" value="{{$award->name}}">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Point Value</label>
                                        <div class="col-sm-3">
                                            <input name="pv" type="number" required class="form-control" value="{{$award->pv}}">
                                            @if ($errors->has('pv'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('pv') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cash Equvalent</label>
                                        <div class="col-sm-3">
                                            <input name="cash_equivalent" type="number" required class="form-control" value="{{$award->cash_equivalent}}">
                                            @if ($errors->has('cash_equivalent'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cash_equivalent') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <div class="btn-toolbar">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-4">
                                                            <button type="submit" class="btn btn-primary mx-3">Edit Award</button>
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
