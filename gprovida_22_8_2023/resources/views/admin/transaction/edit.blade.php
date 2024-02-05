@extends('admin/AdminLayouts.app')

@section('pageTitle', $pageTitle)

@section('styles')

@stop



@section('content')
    <div id="page-content">
        <div id='wrap'>
            <div id="page-heading">
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin/members') }}">Transaction</a></li>
                    <li class="active"><a href="#">View Transaction</a> </li>
                </ol>

                <h1>View Transaction</h1>

            </div>



            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-sky">
                            <div class="panel-heading">
                                <h4>Transaction Details</h4>
                                <div class="options">
                                    <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                                </div>
                            </div>
                            <div class="panel-body collapse in">
                                <br/>
                                <table class="table table-bordered table-condensed">
                                    <tr>
                                        <td><b>Order By</b></td>
                                        <td colspan="2">
                                            {{$transaction->user->firstname}}
                                            {{$transaction->user->lastname}}
                                           ( {{$transaction->user->username}})
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Order For</b></td>
                                        <td colspan="2">
                                            {{$transaction->owner->firstname}}
                                            {{$transaction->owner->lastname}}
                                            ( {{$transaction->owner->username}})
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"> &nbsp</td>
                                    </tr>

                                    <tr>
                                        <td><b>Order Ref</b></td><td><strong>No of Items</strong></td><td><b>Order Status</b></td>
                                    </tr>
                                    <tr>
                                        <td>{{$transaction->orderRef}}</td>
                                        <td>{{$transaction->number_of_items}}</td>
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
                                    </tr>

                                    <tr>
                                        <td><b>Currency</b></td><td><strong>Amount</strong></td><td><b>Payment Status</b></td>
                                    </tr>
                                    <tr>
                                        <td>{{$transaction->currency->code}}</td>
                                        <td>{{$transaction->net_total}}</td>
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
                                    </tr>

                                    <tr>
                                        <td colspan="3"> &nbsp</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><b>Store</b> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" >{{$transaction->store->name}} <br/> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" >
                                            {{$transaction->store->address}}, <br/> {{$transaction->store->address2}}  <br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Country</b></td>
                                        <td><strong>State</strong></td>
                                        <td><b>City</b></td>
                                    </tr>
                                    <tr>
                                        <td>{{$transaction->store->country}}</td>
                                        <td>{{$transaction->store->state}}</td>
                                        <td>{{$transaction->store->city}} </td>
                                    </tr>
                                    <tr><td><b>phone</b></td><td><strong>Email</strong></td><td><b>Website</b></td></tr>
                                    <tr>
                                        <td>{{$transaction->store->phone}}</td>
                                        <td>{{$transaction->store->email}} </td>
                                        <td>{{$transaction->store->website}} </td>
                                    </tr>
                                    <tr><td colspan="3"> &nbsp</td></tr>

                                    <tr><td colspan="3"><b>Items</b></td></tr>
                                    <tr>
                                        <td><b>Product Name</b></td>
                                        <td><b>Qty*Amount</b></td>
                                        <td><b>Total</b></td>
                                    </tr>
                                    @foreach($transaction->items  as $items)
                                        <tr>
                                            <td>{{$items->name}}</td>
                                            <td>{{$items->qty}} * {{$items->amount}}</td>
                                            <td>{{$items->total}}</td>
                                        </tr>
                                    @endforeach
                                    <tr><td></td><td></td>
                                        <td>
                                            <b>
                                                {{ $transaction->currency->prefix }}{{ number_format($transaction->net_total,2) }}
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">&nbsp</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" >
                                            <form action="{{ url('admin/transaction') }}/{{$transaction->id}}" method="post"
                                                  name="transactionForm" id="transactionForm" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="task"  id="task" value="">

                                                <div class="btn-container">
                                                    <button type="submit" {{ $transaction->status_order!="pending"? "disabled":"" }} class="btn btn-success" onclick="acceptOrder()"><i class="fa fa-check-circle"></i>Accept Order</button>&nbsp &nbsp
                                                    <input type="button"  {{ $transaction->status_order!="pending"? "disabled":"" }} value="Cancel Order" onclick="cancelOrder()" class="btn btn-info">&nbsp &nbsp
                                                    <input type="button" {{ $transaction->status_order!="processing"? "disabled":"" }} value="Mark as Shipped" onclick="shipOrder()" class="btn btn-primary">&nbsp &nbsp
                                                    <input type="button" {{ $transaction->status_order!="pending"? "disabled":"" }}  value="Set as Fraud" onclick="fraudOrder()" class="btn btn-danger">
                                                </div>

                                            </form>
                                        </td>
                                    </tr>
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

    <script type="text/javascript">

        var formTransaction = document.transactionForm;
        function acceptOrder(){
            if (confirm("Are you sure you want to Process this Order?")){
                formTransaction.task.value='accept';
                formTransaction.submit();
            }
        }

        function cancelOrder(){
            if (confirm("Are you sure you want to cancel this Order?")){
                formTransaction.task.value='cancel';
                formTransaction.submit();
            }

        }

        function shipOrder(){
            if (confirm("Are you sure you want to Ship this Order?")){
                formTransaction.task.value='ship';
                formTransaction.submit();
            }
        }

        function fraudOrder(){
            if (confirm("Are you sure you want to mark this Order as fraud?")){
                formTransaction.task.value='fraud';
                formTransaction.submit();
            }
        }


    </script>


@stop
