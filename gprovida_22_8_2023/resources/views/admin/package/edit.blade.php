@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)

@section('styles')
    <style>
        .modal-dialog-centered{
            margin-top: 190px
        }
        .package-thumbnail{
            width: 200px;
            height: 150px;
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
                <li>Package</li>
                <li class="active"><a href="{{ url('admin/package') }}">Edit Package</a> </li>
            </ol>

            <h1>Package</h1>

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
                          <h4>Edit Package</h4>

                      </div>
                      <div class="panel-body">

                        <br>
                    <form class="form-horizontal" action="{{ url('admin/package')}}/{{$package->id}}"  method="POST"  enctype='multipart/form-data' >
                       @csrf
						 <input name="_method" type="hidden" value="PUT">

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Package Name</label>
                            <div class="col-sm-3">
                              <input name="name" type="text" class="form-control" value="{{$package->name}}">
                               @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Package description</label>
                            <div class="col-sm-3">
                               <textarea name="description"  row="4" class="form-control">{{$package->description}}</textarea>
                               @if ($errors->has('description'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-3">
                             <select name="type" id="type" class="form-control">
                                 <option value="package" {{ $package->type=="package"? "selected":"" }}>General Package</option>
                                 <option value="stockist" {{ $package->type=="stockist"? "selected":"" }}>Stockist Package</option>
                             </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Referral Bonus</label>
                            <div class="col-sm-3">
                              <input name="referral_bonus" type="text" class="form-control" required value="{{$package->referral_bonus}}" >
                              @if ($errors->has('referral_bonus'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('referral_bonus') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">PV</label>
                            <div class="col-sm-3">
                                <input name="pv" type="text" class="form-control" required value="{{$package->pv}}" >
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
                              <input name="status" id="status" type="hidden" value="{{$package->status}}" />
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">pricing</label>
                            <div class="col-sm-3">
                              <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-label">
                                <i class="fa fa-dollar"></i> Open Pricing
                              </a>
                            </div>
                          </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Featured Image</label>
                            <div class="col-sm-2">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 200px; height: 150px;">
                                    </div>
                                    <div>
                                           <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>


                                                <input type="file" name="featured_image" accept="image/*">
                                           </span>
                                           <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>

                                            @if ($errors->has('featured_image'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('featured_image') }}</strong>
                                                </span>
                                            @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <img src=" {{ url('/').$package->image }} " alt="{{ $package->name }}"
                                     class="img-rounded package-thumbnail">
                            </div>
                        </div>



                         <div class="panel-footer">
                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                <div class="btn-toolbar">
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary"> Save Changes</button>
                                             <button type="reset" class="btn btn-default"> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                         </div>

                          <!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Pricing</h4>
										</div>
										<div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-3"><b>Price</b></div>
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-3"><b>Capping</b></div>
                                            </div>
                                            @foreach($currencies as $currency)
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-3 control-label">
                                                        {{$currency->name}}</label>
                                                    <div class="col-sm-3">
                                                        <input name="{{$currency->code}}" type="number"
                                                               class="form-control" placeholder="price"
                                                               value="{{$currentPrices[$currency->code]?? '' }}"
                                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                                                    </div>
                                                    <div class="col-sm-1"><p>{{$currency->code}}</p></div>
                                                    <div class="col-sm-3">
                                                        <input name="capping_{{$currency->code}}" type="number"
                                                               class="form-control" placeholder="capping"
                                                               value="{{$currentCappings[$currency->code]?? '' }}"
                                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                                                    </div>

                                                </div>
                                            @endforeach
										</div>
										<div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div>
                          <!-- /.modal -->



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

<script>
    $('.toggle').on('toggle', function(e, active) {
        if (active) {
            document.getElementById("status").value="1";
        } else {
            document.getElementById("status").value="0";
        }
    });
</script>

<script src="{{ URL::asset('adminTemplate/plugins/form-jasnyupload/fileinput.js') }}"></script>

@stop
