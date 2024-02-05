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
                <li class="active">Currencies</li>
            </ol>

            <h1>Currencies</h1>

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
                        <h4>Currencies</h4>
                        <div class="options">

                        </div>
                    </div>
                    <div class="panel-body">
                        <p>You can sell in different currencies concurrently by setting them up below. Customers who visit your site can then choose to shop in their local currency.</p>

                        <table class="table table-bordered table-hover table-striped datatables" id="example">
                          <thead>
                            <tr>
                              <th>Currency Name</th>
                              <th>Currency Code</th>
                              <th>Prefix</th>
                              <th>Suffix</th>
                              <th>Format</th>
                              <th>Base Conv. Rate</th>
                              <th>PV Rate</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                          @foreach ($currencies as $currency)
                            <tr>
                               <td>{{ $currency->name }}</td>
                               <td>{{ $currency->code }}</td>
                               <td>{{ $currency->prefix }} </td>
                               <td>{{ $currency->surfix }}</td>
                               <td>
                                 @if ($currency->format == 1)
                                    1234.56
                                 @elseif ($currency->format == 2)
                                     1,234.56
                                 @elseif ($currency->format == 3)
                                     1.234,56
                                 @elseif ($currency->format == 4)
                                     1,234
                                 @else
                                     {{ $currency->format }}
                                 @endif
                               </td>
                               <td>{{ $currency->BaseRate }}</td>
                               <td>{{ $currency->pv_rate }}</td>

                               <td>
                               <a href="{{ url('admin/currency/'.$currency->id.'/edit/') }}">
                                 <img src="/adminTemplate/img/edit.gif" alt="Edit" width="16" height="16" border="0">
                               </a>

                               </td>

                               <td>
                                   @if ($currency->base === 1)
                                   @else
                        {{ Form::open(array('url' => 'admin/currency/' . $currency->id, 'class' => ' ',
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
                          <h4>Add Additional Currency</h4>

                      </div>
                      <div class="panel-body">

                        <br>
                    <form class="form-horizontal" action="{{ url('admin/currency') }}"  method="POST"  >
                       {{ csrf_field() }}
                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Currency Name</label>
                            <div class="col-sm-3">
                              <input name="name" type="text" class="form-control" id="focusedinput" placeholder="Currency Name">
                               @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <p class="help-block">eg. Naira.</p>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Currency Code</label>
                            <div class="col-sm-3">
                              <input name="code" type="text" class="form-control" id="focusedinput" placeholder="Currency Code">
                               @if ($errors->has('code'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <p class="help-block">eg. USD, GBP, etc...</p>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Prefix</label>
                            <div class="col-sm-3">
                              <input name="prefix" type="text" class="form-control" id="focusedinput" placeholder="prefix">
                               @if ($errors->has('prefix'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Suffix</label>
                            <div class="col-sm-3">
                              <input name="suffix" type="text" class="form-control" id="focusedinput" placeholder="suffix">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="selector1" class="col-sm-3 control-label">Format</label>
                            <div class="col-sm-3">
                              <select name="currency_format" id="currency_format" class="form-control">
                                    <option value="1">1234.56</option>
                                    <option value="2">1,234.56</option>
                                    <option value="3">1.234,56</option>
                                    <option value="4">1,234</option>
                              </select>
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="col-sm-3 control-label">Base Conv. Rate</label>
                            <div class="col-sm-3">
                              <input name="BaseRate" type="text" class="form-control">
                              @if ($errors->has('BaseRate'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('BaseRate') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">PV Conv. Rate</label>
                            <div class="col-sm-3">
                                <input name="pv_rate" type="text" class="form-control">
                                @if ($errors->has('pv_rate'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('pv_rate') }}</strong>
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
                                            <button type="submit" class="btn btn-primary"> Add Currency</button>
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
