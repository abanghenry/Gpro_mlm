@extends('admin/AdminLayouts.app')

@section('pageTitle', 'Currency')


@section('content')

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="index.php">Dashboard</a></li>
                <li>Payment/Localisation</li>
                <li class="active"><a href="{{ url('admin/currency') }}">Currencies</a> </li>
            </ol>

            <h1>Currencies</h1>

        </div>

        <div class="container">





            <div class="row">
                <div class="col-sm-12">
                  <div class="panel panel-primary">
                      <div class="panel-heading">
                          <h4>Edit Currency</h4>

                      </div>
                      <div class="panel-body">

                        <br>
                    <form class="form-horizontal" action="{{ url('admin/currency')}}/{{$currency->id}}"  method="POST"  >
                       @csrf
						 <input name="_method" type="hidden" value="PUT">

                        <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Currency Name</label>
                            <div class="col-sm-3">
                              <input name="name" type="text" class="form-control" id="focusedinput" value="{{$currency->name}}">
                               @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Currency Code</label>
                            <div class="col-sm-3">
                              <input name="code" type="text" class="form-control" id="focusedinput" value="{{$currency->code}}">
                               @if ($errors->has('code'))
                                    <span class="help-block">
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
                              <input name="prefix" type="text" class="form-control" id="focusedinput" value="{{$currency->prefix}}">
                               @if ($errors->has('prefix'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="focusedinput" class="col-sm-3 control-label">Suffix</label>
                            <div class="col-sm-3">
                              <input name="suffix" type="text" class="form-control" id="focusedinput" value="{{$currency->suffix}}">
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
                            <label for="focusedinput" class="col-sm-3 control-label">Base Conv. Rate</label>
                            <div class="col-sm-3">
                              <input name="BaseRate" type="text" class="form-control" id="focusedinput" value="{{$currency->BaseRate}}">           </div>
                          </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">PV Conv. Rate</label>
                                <div class="col-sm-3">
                                    <input name="pv_rate" type="text" class="form-control"  value="{{$currency->pv_rate}}"> </div>
                            </div>



                         <div class="panel-footer">
                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                <div class="btn-toolbar">
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary"> Edit Currency</button>
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
