@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)

@section('style')
    <link rel='stylesheet' type='text/css' href="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.css') }}" />
@stop



@section('content')

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="index.php">Dashboard</a></li>
                <li>Settings</li>
                <li class="active">{{$pageTitle}}</li>
            </ol>

            <h1>{{$pageTitle}}</h1>

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
                        <h4>Currencies</h4>
                        <div class="options">

                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover table-striped datatables" id="example">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Fullname</th>
                              <th>Country Code</th>
                              <th>currency</th>
                              <th>flag</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                          @foreach ($countries as $country)
                            <tr>
                               <td>{{ $country->name }}</td>
                               <td>{{ $country->full_name }}</td>
                               <td>{{ $country->iso_3166_3 }} </td>
                               <td>{{ $country->currency }}</td>
                               <td> <img src="{{ url('flags/'.$country->flag) }}"> </td>
                               <td>
                               <a href="{{ url('admin/country/'.$country->id) }}">
                                 <img src="/adminTemplate/img/edit.gif" alt="Edit" width="16" height="16" border="0">
                               </a>

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
</div> <!-- page-content -->




@endsection



@section('scripts')
<script src="{{ URL::asset('adminTemplate/plugins/datatables/jquery.dataTables.min.js')    }}"></script>
<script src="{{ URL::asset('adminTemplate/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ URL::asset('adminTemplate/demo/demo-datatables.js') }}"></script>

<script>

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
