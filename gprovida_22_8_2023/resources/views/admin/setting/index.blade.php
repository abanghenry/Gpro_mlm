
@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)


@section('style')
    <link rel='stylesheet' type='text/css' href="{{ URL::asset('adminTemplate/plugins/form-xeditable/bootstrap3-editable/css/bootstrap-editable.css') }}" />
@stop

@section('content')
    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">{{ $pageTitle }}</li>
                </ol>

                <h1>{{ $pageTitle }}</h1>

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
                <div class="col-md-12">

                <div class="panel panel-green">
                    <div class="panel-heading">
                        <h4>Setting</h4>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="popovers">
                                <form action="{{url('admin/setting') }}" method="POST"  class="form-horizontal row-border">

                                {{ csrf_field() }}
                                    @foreach($settings as $setting)
                                        @if($setting->type=='text')
                                            <div class="form-group">
                                                <label for="focusedinput" class="col-sm-3 control-label">{{$setting->text}}</label>
                                                <div class="col-sm-3">
                                                    <input name="{{$setting->key}}" type="text" class="form-control"
                                                           value="{{$setting->value}}" required>
                                                    @if ($errors->has($setting->key))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first($setting->key) }}</strong>
                                                        </span>
                                                    @endif
                                                    <p class="help-block">{{$setting->description}}</p>
                                                </div>
                                            </div>
                                        @elseif($setting->type=='date')
                                            <div class="form-group">
                                                <label for="focusedinput" class="col-sm-3 control-label">{{$setting->text}}</label>
                                                <div class="col-sm-3">
                                                    <input name="{{$setting->key}}" type="date" class="form-control"
                                                           value="{{$setting->value}}" required>
                                                    @if ($errors->has($setting->key))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first($setting->key) }}</strong>
                                                        </span>
                                                    @endif
                                                    <p class="help-block">{{$setting->description}}</p>
                                                </div>
                                            </div>
                                        @elseif($setting->type=='select')
                                            <div class="form-group">
                                                <label for="focusedinput" class="col-sm-3 control-label">{{$setting->text}}</label>
                                                <div class="col-sm-3">
                                                    <select name="{{$setting->key}}" class="form-control">
                                                        @foreach($setting->Optionsarray as $selectOpt)
                                                            <option value="{{ $selectOpt }}" @selected($setting->value == $selectOpt)>
                                                            {{ $selectOpt }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has($setting->key))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first($setting->key) }}</strong>
                                                        </span>
                                                    @endif
                                                    <p class="help-block">{{$setting->description}}</p>
                                                </div>
                                            </div>
                                        @elseif($setting->type=='check')
                                        @elseif($setting->type=='options')
                                        @elseif($setting->type=='textarea')
                                            <div class="form-group">
                                                <label for="focusedinput" class="col-sm-3 control-label">{{$setting->text}}</label>
                                                <div class="col-sm-3">
                                                    <textarea name="{{$setting->key}}"  rows="6" class="form-control" required>{{$setting->value}}</textarea>
                                                    @if ($errors->has($setting->key))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first($setting->key) }}</strong>
                                                        </span>
                                                    @endif
                                                    <p class="help-block">{{$setting->description}}</p>
                                                </div>
                                            </div>
                                        @else

                                        @endif


                                    @endforeach


                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{ URL::asset('adminTemplate/plugins/form-daterangepicker/moment.min.js')    }}"></script>
    <script src="{{ URL::asset('adminTemplate/plugins/form-xeditable/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ URL::asset('adminTemplate/demo/demo-xeditable.js') }}"></script>
@stop
