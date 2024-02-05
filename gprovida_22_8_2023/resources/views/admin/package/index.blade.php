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
                <li class="active">Package</li>
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
              <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Package</h4>
                        <div class="options">

                        </div>
                    </div>
                    <div class="panel-body">


                        <table class="table table-bordered table-hover table-striped datatables" id="example">
                          <thead>
                            <tr>
                              <th><i class="fa fa-image"></i></th>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Referral Bonus</th>
                              <th>PV</th>
                              <th>Status</th>
                              <th>Type</th>
                              <th>Created</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                          @foreach ($packages as $package)
                            <tr>
                                <td>
                                    <img src=" {{ url('/').$package->image }} " alt="{{ $package->name }}"
                                         class="img-rounded product-thumbnail">
                                </td>
                               <td>{{ $package->name }}</td>
                               <td>{{ $package->description }}</td>
                               <td>{{ $package->referral_bonus }} </td>
                                <td>{{ $package->pv }} </td>
                               <td>
                                 @if ($package->status == 1)
                                    Active
                                 @else
                                    Disabled
                                 @endif
                               </td>
                               <td>{{ $package->type }}</td>
                               <td>{{ $package->created_at }}</td>

                               <td>
                               <a href="{{ url('admin/package/'.$package->id.'/edit/') }}">
                                 <img src="/adminTemplate/img/edit.gif" alt="Edit" width="16" height="16" border="0">
                               </a>

                               </td>

                               <td>

                        {{ Form::open(array('url' => 'admin/package/' . $package->id, 'class' => ' ',
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





            <div class="row">
                <div class="col-sm-12">
                  <div class="panel panel-primary">
                      <div class="panel-heading">
                          <h4>Add New Package</h4>

                      </div>
                      <div class="panel-body">

                      <br>
                      <form class="form-horizontal" action="{{ url('admin/package') }}"  method="POST" enctype='multipart/form-data' >
                       {{ csrf_field() }}
                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Package Name</label>
                            <div class="col-sm-3">
                              <input name="name" type="text" class="form-control" placeholder="Package Name">
                               @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">

                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Package description</label>
                            <div class="col-sm-3">
                               <textarea name="description"  row="4" class="form-control"></textarea>
                               @if ($errors->has('code'))
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
                                    <option value="package">General Package</option>
                                    <option value="stockist">Stockist Package</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Referral Bonus (%)</label>
                            <div class="col-sm-3">
                              <input name="referral_bonus" type="text" class="form-control"  placeholder="Referral Bonus">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">PV</label>
                            <div class="col-sm-3">
                                <input name="pv" type="text" class="form-control" placeholder="point Value">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-3 control-label">
                              <div class="toggle"></div>
                              <input name="status" id="status" type="hidden" value="1">
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


                         <div class="panel-footer">
                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                <div class="btn-toolbar">
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary"> Create Package</button>
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

                                            @foreach($currencies as $currency)
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-3 control-label">
                                                        {{$currency->name}}</label>
                                                    <div class="col-sm-3">
                                                        <input name="{{$currency->code}}" type="number"
                                                               class="form-control" placeholder="price"
                                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                                                    </div>
                                                    <div class="col-sm-1"><p>{{$currency->code}}</p></div>
                                                    <div class="col-sm-3">
                                                        <input name="capping_{{$currency->code}}" type="number"
                                                               class="form-control" placeholder="capping"
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
</div>
@endsection



@section('scripts')
<script src="{{ URL::asset('adminTemplate/plugins/datatables/jquery.dataTables.min.js')    }}"></script>
<script src="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ URL::asset('adminTemplate/plugins/form-jasnyupload/fileinput.js') }}"></script>




<script>



$('.toggle').on('toggle', function(e, active) {
  if (active) {
    console.log('Toggle is now ON!');
    document.getElementById("status").value="1";
  } else {
    console.log('Toggle is now OFF!');
    document.getElementById("status").value="0";
  }
});


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
