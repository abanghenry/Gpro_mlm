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

        .deleted-row {
            text-decoration: line-through;
            background-color: red;
        }

    </style>
@stop



@section('content')

    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin/') }}">Dashboard</a></li>
                    <li class="active">transaction</li>
                </ol>

                <h1>Transaction</h1>

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
                    <div class="col-md-2">
                        <a class="info-tiles tiles-success" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">Total Transaction</div>
                                <div class="pull-right"></div>
                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-shopping-cart"></i></div>
                                <div class="pull-right">{{ number_format($totalTransactions) }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a class="info-tiles tiles-orange" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">Pending</div>
                                @if($totalTransactions>0)
                                    <div class="pull-right">{{ number_format(($totalTransactionsPending/$totalTransactions)*100) }}%  </div>
                                @else
                                    <div class="pull-right">0% </div>
                                @endif
                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-shopping-cart"></i></div>
                                <div class="pull-right">{{ number_format($totalTransactionsPending) }} </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a class="info-tiles tiles-brown" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">process</div>
                                @if($totalTransactions>0)
                                    <div class="pull-right">{{ number_format(($totalTransactionsProcessing/$totalTransactions)*100) }}% </div>
                                @else
                                    <div class="pull-right">0% </div>
                                @endif
                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-shopping-cart"></i></div>
                                <div class="pull-right">{{ number_format($totalTransactionsProcessing) }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a class="info-tiles tiles-midnightblue" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">Shipped</div>
                                @if($totalTransactions>0)
                                <div class="pull-right">{{ number_format(($totalTransactionsShipped/$totalTransactions)*100) }}% </div>
                                @else
                                    <div class="pull-right">0% </div>
                                @endif

                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-shopping-cart"></i></div>
                                <div class="pull-right">{{ number_format($totalTransactionsShipped) }}</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-2">
                        <a class="info-tiles tiles-midnightblue" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">Cancelled</div>
                                @if($totalTransactions>0)
                                    <div class="pull-right">{{ number_format(($totalTransactionsCancelled/$totalTransactions)*100) }}% </div>
                                @else
                                    <div class="pull-right">0% </div>
                                @endif
                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-shopping-cart"></i></div>
                                <div class="pull-right">{{ number_format($totalTransactionsCancelled) }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a class="info-tiles tiles-midnightblue" href="#">
                            <div class="tiles-heading">
                                <div class="pull-left">Fraud</div>
                                @if($totalTransactions>0)
                                    <div class="pull-right">{{ number_format(($totalTransactionsFraud/$totalTransactions)*100) }}% </div>
                                @else
                                    <div class="pull-right">0% </div>
                                @endif
                            </div>
                            <div class="tiles-body">
                                <div class="pull-left"><i class="fa fa-shopping-cart"></i></div>
                                <div class="pull-right">{{ number_format($totalTransactionsFraud) }}</div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4>Transaction</h4>
                                <div class="options">

                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped  datatables" id="example">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ref</th>
                                            <th>Customer</th>
                                            <th>Store</th>
                                            <th># of Items Types</th>
                                            <th>Total</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                            <th>Order Status</th>
                                            <th>Order Date</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaction->orderRef }}</td>
                                                <td>{{ $transaction->owner->firstname }}  {{ $transaction->owner->lastname }}
                                                    (  {{ $transaction->owner->username }} )
                                                </td>
                                                <td>{{ $transaction->store->name }} </td>
                                                <td>{{ $transaction->number_of_items }}</td>
                                                <td>
                                                    {{ $transaction->currency->prefix }}{{ number_format($transaction->net_total,2) }}
                                                </td>
                                                <td>{{ $transaction->payment_method }}</td>
                                                <td>
                                                    @if($transaction->payment_status == "pending")
                                                        <span class="label label-warning">{{ $transaction->payment_status  }}</span>
                                                    @elseif($transaction->payment_status =="paid")
                                                        <span class="label label-success">{{ $transaction->payment_status  }}</span>
                                                    @elseif($transaction->payment_status =="cancelled")
                                                        <span class="label label-default">{{ $transaction->payment_status  }}</span>
                                                    @elseif($transaction->payment_status =="fraud")
                                                        <span class="label label-danger">{{ $transaction->payment_status  }}</span>
                                                    @else
                                                        <span class="label label-warning">{{ $transaction->payment_status  }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($transaction->status_order == "pending")
                                                        <span class="label label-warning">{{ $transaction->status_order  }}</span>
                                                    @elseif($transaction->status_order =="processing")
                                                        <span class="label label-primary">{{ $transaction->status_order  }}</span>
                                                    @elseif($transaction->status_order =="shipped")
                                                        <span class="label label-success">{{ $transaction->status_order  }}</span>
                                                    @elseif($transaction->status_order =="cancelled")
                                                        <span class="label label-default">{{ $transaction->status_order  }}</span>
                                                    @elseif($transaction->status_order =="fraud")
                                                        <span class="label label-danger">{{ $transaction->status_order  }}</span>
                                                    @else
                                                        <span class="label label-warning">{{ $transaction->status_order  }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $transaction->order_date }} </td>
                                                <td>
                                                    <a  class="btn btn-primary btn-xs" href="{{ url('admin/transaction')}}/{{$transaction->id}}">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

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
