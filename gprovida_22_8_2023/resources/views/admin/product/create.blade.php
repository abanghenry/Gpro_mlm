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
                <li>Product</li>
                <li class="active"><a href="{{ url('admin/package') }}">Create Product</a> </li>
            </ol>

            <h1>Product</h1>

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
                          <h4>Create product</h4>

                      </div>
                      <div class="panel-body">

                        <br>
                    <form class="form-horizontal" action="{{ url('admin/product')}}"  method="POST" enctype='multipart/form-data' >
                       @csrf
                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Product Name</label>
                            <div class="col-sm-3">
                              <input name="name" type="text" class="form-control" required>
                               @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Product description</label>
                            <div class="col-sm-3">
                               <textarea name="description"  rows="6" class="form-control" required></textarea>
                               @if ($errors->has('description'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Category</label>
                            <div class="col-sm-3">
                             <select name="category" id="category" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                             </select>
                            </div>
                          </div>


                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-3">
                                <select name="type" id="type" class="form-control">
                                    <option value="1">MLM & Retail</option>
                                    <option value="2">MLM Only</option>
                                    <option value="3">Retail Only</option>
                                </select>
                            </div>
                        </div>



                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Point Value (PV)</label>
                            <div class="col-sm-3">
                              <input name="pv" type="text" class="form-control" required >
                              @if ($errors->has('pv'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('pv') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-3 control-label">
                              <div class="toggle"></div>
                              <input name="active" id="active" type="hidden" value="1">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label"></label>
                            <div class="col-sm-8">
                                <hr/>
                            </div>
                          </div>


                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">pricing</label>
                            <div class="col-sm-3">
                                @foreach($currencies as $currency)
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">{{ $currency->code }}</label>
                                    <div class="col-sm-8">
                                     <input name="{{$currency->code}}" type="text"
                                     class="form-control" required >
                                    </div>
                                  </div>
                                <br/>
                                @endforeach
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="col-sm-3 control-label">Featured Image</label>
                            <div class="col-sm-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                        style="width: 200px; height: 150px;">
                                    </div>
                                    <div>
                                       <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="featured_image" accept="image/*"></span>
                                        <a href="#" class="btn btn-default fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="col-sm-3 control-label">Image Gallery</label>
                            <div class="col-sm-9">
                            <input type="file" id="image_gallery" name="image_gallery[]" accept="image/*"  multiple />
                            </div>
                          </div>


                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Inventory</label>
                            <div class="col-sm-8">
                                <hr/>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Product SKU</label>
                            <div class="col-sm-3">
                              <input name="sku" type="text" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Starting Quantity</label>
                            <div class="col-sm-3">
                              <input name="starting_inventory" type="number" class="form-control"
                              oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" >
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Minimum Quantity</label>
                            <div class="col-sm-3">
                              <input name="minimum_required" type="number" class="form-control"
                              oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" >
                            </div>
                          </div>



                         <div class="panel-footer">
                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                <div class="btn-toolbar">
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary"> Create Product</button>
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


<script>
    $('.toggle').on('toggle', function(e, active) {
    if (active) {
        document.getElementById("active").value="1";
    } else {
        document.getElementById("active").value="0";
    }
    });

</script>
@stop
