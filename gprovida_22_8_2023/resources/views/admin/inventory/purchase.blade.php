@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)

@section('styles')

    <link href="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ URL::asset('adminTemplate/datepicker/bootstrap-datepicker.css') }}" rel='stylesheet' type='text/css' />

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
                <li class="active">Purchase</li>
            </ol>

            <h1>Purchase</h1>

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
                          <h4>Purchase New product for Store</h4>
                      </div>
                      <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('admin/inventory/purchase') }}"  method="POST" >
                       {{ csrf_field() }}

                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Product</label>
                            <div class="col-sm-3">
                             <select name="product_id" id="type" class="form-control">
                                  @foreach($products as $product)
                                  <option value="{{$product->id}}">{{$product->category->name}}: {{$product->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Supplier</label>
                            <div class="col-sm-3">
                             <select name="supplier_id" id="type" class="form-control">
                                  @foreach($suppliers as $supplier)
                                  <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Receiving Store</label>
                            <div class="col-sm-3">
                             <select name="store_id" id="type" class="form-control">
                                  @foreach($stores as $store)
                                  <option value="{{$store->id}}">{{$store->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>



                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Quantity Received</label>
                            <div class="col-sm-3">
                              <input name="number_received" type="text" class="form-control" required>
                               @if ($errors->has('number_received'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('number_received') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Purchase Date</label>
                            <div class="col-sm-3">
                                <div id="purchase_date" class="input-group date" >
                                    <input type="text" name="purchase_date" class="form-control">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                @if ($errors->has('purchase_date'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('purchase_date') }}</strong>
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
                                            <button type="submit" class="btn btn-primary">Create Store</button>
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




            <br/> <br/> <br/>
            <div class="row">
              <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Purchase History</h4>
                        <div class="options">
                        </div>
                    </div>
                    <div class="panel-body">

                    <table class="table table-bordered table-hover table-striped datatables" id="example">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Receiving Store </th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($purchases as $purchase)
                        <tr
                         @if($purchase->deleted_at)
                          class="deleted"
                         @endif>
                            <td>{{ $purchase->product?->name }}</td>
                            <td>{{ $purchase->supplier?->name }} </td>
                            <td>{{ $purchase->store?->name }}</td>
                            <td>{{ $purchase->number_received }}</td>
                            <td>{{ $purchase->purchase_date }} </td>
                            <td>
                            {{ Form::open(array('url' => 'admin/inventory/purchase/' . $purchase->id, 'class' => ' ',
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














        </div> <!-- container -->
    </div> <!--wrap -->
</div>
@endsection



@section('scripts')
<script src="{{ URL::asset('adminTemplate/plugins/datatables/jquery.dataTables.min.js')    }}"></script>
<script src="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ URL::asset('adminTemplate/plugins/form-jasnyupload/fileinput.js') }}"></script>

<script src="{{ URL::asset('adminTemplate/datepicker/bootstrap-datepicker.js') }}"></script>




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


$('#purchase_date input').datepicker({
    format: "yyyy-mm-dd",
    orientation: "top right",
    endDate: '-0d'
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
