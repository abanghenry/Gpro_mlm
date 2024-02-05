@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)

@section('styles')

    <link href="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.css') }}" rel='stylesheet' type='text/css' />


    <style>
        .modal-dialog-centered{
           margin-top: 190px
        }

        .product-thumbnail{
            width: 40px;
            height: 40px;
            overflow: hidden;
        }
        .store-thumbnail{
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
                <li>Inventory</li>
                <li class="active">Stores</li>
            </ol>

            <h1>Stores</h1>

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
                        <h4>Stores</h4>
                        <div class="options">

                        </div>
                    </div>
                    <div class="panel-body">

                    <table class="table table-bordered table-hover table-striped datatables" id="example">
                        <thead>
                        <tr>
                            <th><i class="fa fa-image"></i></th>
                            <th>Name</th>
                            <th>Package</th>
                            <th>Address</th>
                            <th>City, State</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Managers</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($stores as $store)
                        <tr>
                            <td>
                                <img src=" {{ url('/').$store->image_url }} " alt="{{ $store->name }}"
                                class="img-rounded store-thumbnail">
                            </td>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->package?->name }}</td>
                            <td>{{ $store->address }} <br/>{{ $store->address2 }}</td>
                            <td>{{ $store->city }}, {{ $store->state }} </td>
                            <td>{{ $store->country }}</td>
                            <td>{{ $store->phone }}</td>
                            <td>{{ $store->email }}</td>
                            <td>
                                @foreach($store->managers as $manager)
                                    {{$manager->user->username}}
                                    ( {{$manager->user->firstname}} {{$manager->user->lastname}}  )
                                    <br/>
                                @endforeach
                            </td>
                            <td>
                            <a href="{{ url('admin/store/'.$store->id.'/edit/') }}">
                                <img src="/adminTemplate/img/edit.gif" alt="Edit" width="16" height="16" border="0">
                            </a>
                            </td>

                            <td>
                                @if ($store->id === 1)
                                @else
                                    {{ Form::open(array('url' => 'admin/store/' . $store->id, 'class' => ' ',
                                        'onsubmit' => 'return ConfirmDelete()')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                        {!! Form::button('<i class="fa fa-trash-o"></i>',
                                            array('type' => 'submit', 'class' => 'btn btn-danger btn-xs')) !!}
                                    {{ Form::close() }}
                                @endif
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
                          <h4>Create New Store</h4>
                      </div>
                      <div class="panel-body">

                        <br>
                    <form class="form-horizontal" action="{{ url('admin/store') }}"  method="POST" enctype='multipart/form-data' >
                       {{ csrf_field() }}

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Store Name</label>
                            <div class="col-sm-3">
                              <input name="name" type="text" class="form-control" placeholder="Store Name" required>
                               @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="focusedinput" class="col-sm-1 control-label">Managers</label>
                            <div class="col-sm-5">
                            <select name="managers[]" id="e2" multiple style="width:100%" class="populate" required ></select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Slug</label>
                            <div class="col-sm-3">
                              <input name="slug" type="text" class="form-control">
                               @if ($errors->has('slug'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Package</label>
                              <div class="col-sm-3">
                                  <select name="package_id" class="form-control">
                                      @foreach($packages as $package)
                                          <option value="{{$package->id}}">{{$package->name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>



                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Store description</label>
                            <div class="col-sm-3">
                               <textarea name="description"  rows="4" class="form-control"></textarea>
                               @if ($errors->has('description'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-3">
                              <input name="address" type="text" class="form-control"  required>
                              @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Address 2</label>
                            <div class="col-sm-3">
                              <input name="address2" type="text" class="form-control">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">City</label>
                            <div class="col-sm-3">
                              <input name="city" type="text" class="form-control" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">State</label>
                            <div class="col-sm-3">
                              <input name="state" type="text" class="form-control" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Country</label>
                            <div class="col-sm-3">
                            <select name="country" class="form-control">
                                  @foreach($countries as $country)
                                  <option value="{{$country->name}}">{{$country->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Phone</label>
                            <div class="col-sm-3">
                              <input name="phone" type="phone" class="form-control" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-3">
                              <input name="email" type="email" class="form-control" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Website</label>
                            <div class="col-sm-3">
                              <input name="website" type="text" class="form-control" value="http://">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Map</label>
                            <div class="col-sm-3">
                              <input name="map" type="text" class="form-control">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Store Banner</label>
                            <div class="col-sm-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail"
                                    data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                    <div>
                                       <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="banner"></span>
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
                                            <button type="submit" class="btn btn-primary"> Create Store</button>
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
</div>
@endsection



@section('scripts')
<script src="{{ URL::asset('adminTemplate/plugins/datatables/jquery.dataTables.min.js')    }}"></script>
<script src="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ URL::asset('adminTemplate/plugins/form-jasnyupload/fileinput.js') }}"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
