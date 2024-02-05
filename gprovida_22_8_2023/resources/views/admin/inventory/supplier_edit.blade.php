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
                <li><a href="index.php">Dashboard</a></li>
                <li>Product Supplier</li>
                <li class="active"><a href="{{ url('admin/inventory/supplier') }}">Product Supplier</a> </li>
            </ol>

            <h1>Product Supplier</h1>

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
                          <h4>Edit Product Supplier </h4>

                      </div>
                      <div class="panel-body">

                        <br>
                    <form class="form-horizontal" action="{{ url('admin/inventory/supplier/'.$supplier->id)}}"  method="POST" >
                       @csrf
                       <input name="_method" type="hidden" value="PUT">
                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Supplier Name</label>
                            <div class="col-sm-3">
                              <input name="name" type="text" class="form-control"  required value="{{ $supplier->name}}">
                               @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Supplier description</label>
                            <div class="col-sm-3">
                               <textarea name="description"  rows="6" class="form-control">{{ $supplier->desc}} </textarea>
                               @if ($errors->has('desc'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('desc') }}</strong>
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
                                            <button type="submit" class="btn btn-primary">Update Supplier</button>
                                             <button type="reset" class="btn btn-default">Cancel</button>
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


@stop
