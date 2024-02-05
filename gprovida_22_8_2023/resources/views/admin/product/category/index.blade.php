@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)

@section('styles')

    <link rel='stylesheet' type='text/css' href="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.css') }}" />
    <style>
        .modal-dialog-centered{
           margin-top: 190px
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
                <li class="active">Category</li>
            </ol>

            <h1>Category</h1>

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



            <div class="row">
              <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Category</h4>
                        <div class="options">

                        </div>
                    </div>
                    <div class="panel-body">


                        <table class="table table-bordered table-hover table-striped datatables" id="example">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Slug</th>
                              <th>Count</th>
                              <th>Parent</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                          @foreach ($categories as $category)
                            <tr>
                               <td>{{ $category->name }}</td>
                               <td>{{ $category->desc }}</td>
                               <td>{{ $category->slug }} </td>
                               <td>{{ $category->products_count }}</td>
                               <td>{{ $category->parentCategory ? $category->parentCategory->name : null; }}</td>
                               <td>
                               <a href="{{ url('admin/category/'.$category->id.'/edit/') }}">
                                 <img src="/adminTemplate/img/edit.gif" alt="Edit" width="16" height="16" border="0">
                               </a>

                               </td>

                               <td>

                        {{ Form::open(array('url' => 'admin/category/' . $category->id, 'class' => ' ',
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
                          <h4>Add New Category</h4>

                      </div>
                      <div class="panel-body">

                        <br>
                    <form class="form-horizontal" action="{{ url('admin/category') }}"  method="POST" >
                       {{ csrf_field() }}
                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">category Name</label>
                            <div class="col-sm-3">
                              <input name="name" type="text" class="form-control">
                               @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>


                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Slug</label>
                            <div class="col-sm-3">
                              <input name="slug" type="text" class="form-control" >
                              @if ($errors->has('slug'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Parent Category</label>
                            <div class="col-sm-3">
                            <select name="parent" id="type" class="form-control">
                                    <option value="">none</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                              </select>
                            </div>
                          </div>



                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">category description</label>
                            <div class="col-sm-3">
                               <textarea name="desc"  rows="6" class="form-control"></textarea>
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
                                            <button type="submit" class="btn btn-primary"> Create Category</button>
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
