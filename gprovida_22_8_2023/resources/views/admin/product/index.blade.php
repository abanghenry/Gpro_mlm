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
                <li>Settings</li>
                <li class="active">Product</li>
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
              <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Product</h4>
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
                              <th>SKU</th>
                              <th>Status</th>
                              <th>Category</th>
                              <th>Type</th>
                              <th>price</th>
                              <th>PV</th>
                              <th>Created</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                          @foreach ($products as $product)
                            <tr>
                               <td>
                                    <img src=" {{ url('/').$product->image_url }} " alt="{{ $product->name }}"
                                    class="img-rounded product-thumbnail">
                               </td>

                               <td>{{ $product->name }}</td>
                               <td>{{ $product->desc }}</td>
                               <td>{{ $product->sku }} </td>
                               <td>
                                 @if ($product->active == 1)
                                    <span class="label label-success">Active</span>
                                 @else

                                    <span class="label label-danger">Disabled</span>
                                 @endif
                               </td>
                               <td>{{ $product->category->name }}</td>
                                <td>
                                    @if ($product->type == 1)
                                        <span class="label label-success">MLM & Retail</span>
                                    @elseif($product->type == 2)
                                        <span class="label label-success">MLM Only</span>
                                    @elseif($product->type == 3)
                                        <span class="label label-success">Retail Only</span>
                                    @else
                                        <span class="label label-danger">Error</span>
                                    @endif
                                </td>

                               <td width="10%" >
                                  @foreach($product->price as $price)
                                       {{$price->currency->code}} : {{ $price->price}}
                                       <br/>
                                  @endforeach
                               </td>
                               <td>{{ $product->pv }}</td>
                               <td>{{ $product->created_at }}</td>

                               <td>
                               <a href="{{ url('admin/product/'.$product->id.'/edit/') }}">
                                 <img src="/adminTemplate/img/edit.gif" alt="Edit" width="16" height="16" border="0">
                               </a>

                               </td>

                               <td>

                        {{ Form::open(array('url' => 'admin/product/' . $product->id, 'class' => ' ',
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
