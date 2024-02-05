<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderConfirmed;
use App\Events\OrderShipped;
use App\Http\Controllers\Controller;
use App\Mail\TestimonialCreated;
use App\Models\Order;
use App\Models\Pin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{


    public function index(Request $request)
    {

        if($request->status){
            switch ($request->status){
                case 'pending':
                    $transactions = Order::where('status_order','pending')
                        ->with(['owner','store', 'currency'])
                        ->orderBy('id','desc')->get();
                    break;
                case 'processing':
                    $transactions = Order::where('status_order','processing')
                        ->with(['owner','store', 'currency'])
                        ->orderBy('id','desc')->get();
                    break;
                case 'shipped':
                    $transactions = Order::where('status_order','shipped')
                        ->with(['owner','store', 'currency'])
                        ->orderBy('id','desc')->get();
                    break;
                case 'cancelled':
                    $transactions = Order::where('status_order','cancelled')
                        ->with(['owner','store', 'currency'])
                        ->orderBy('id','desc')->get();
                    break;
                case 'fraud':
                    $transactions = Order::where('status_order','fraud')
                        ->with(['owner','store', 'currency'])
                        ->orderBy('id','desc')->get();
                    break;
                default:
                    $transactions = Order::with(['owner','store', 'currency'])
                        ->orderBy('id','desc')->get();
            }
        }else{
            $transactions = Order::with(['owner','store', 'currency'])->orderBy('id','desc')->get();
        }

        $totalTransactionsPending    = DB::table('orders')->where('status_order', "pending")->count();
        $totalTransactionsProcessing = DB::table('orders')->where('status_order', "processing")->count();
        $totalTransactionsShipped    = DB::table('orders')->where('status_order', "shipped")->count();
        $totalTransactionsCancelled  = DB::table('orders')->where('status_order', "cancelled")->count();
        $totalTransactionsFraud      = DB::table('orders')->where('status_order', "fraud")->count();

        return view('admin.transaction.index')->with([
            'pageTitle' => "transaction",
            'transactions' => $transactions,
            'totalTransactions' => count($transactions),
            'totalTransactionsPending' => $totalTransactionsPending,
            'totalTransactionsProcessing' => $totalTransactionsProcessing,
            'totalTransactionsShipped' => $totalTransactionsShipped,
            'totalTransactionsCancelled' => $totalTransactionsCancelled,
            'totalTransactionsFraud' => $totalTransactionsFraud,

        ]);

    }


    public function show($id){
        $transaction = Order::with('items','owner','user','currency', 'store')->find($id);
        return view('admin.transaction.edit')->with([
            'pageTitle' => "Transaction",
            'transaction'=>$transaction,
        ]);
    }

    public function update(Request $request, $id){
        $order = Order::find($id);

        switch ($request->task){
            case 'accept':
                $this->acceptOrder($order);
                break;
            case 'cancel':
                $this->cancelOrder($order);
                break;
            case 'ship':
                $this->shipOrder($order);
                break;
            case 'fraud':
                $this->fraudOrder($order);
                break;
            default:

        }

        return redirect('admin/transaction')->with(['status'=>'Order Updated successfully' ]);
    }

    public function acceptOrder(Order $order){
        if($order->status_order=="pending"){
            $order->status_order ="processing";
            $order->payment_status ="paid";
            $order->save();
            $order->load('items','owner','user','currency', 'store');
            Mail::to($order->owner)->queue(new \App\Mail\OrderConfirmed($order, $order->owner, false));
            // send queue email to all admin
            $systemAdmins = User::where('type',User::ADMIN_USER)->pluck('email');
            foreach ($systemAdmins as $recipient) {
                Mail::to($recipient)->queue(new \App\Mail\OrderConfirmed($order, $order->owner, true));
            }
            event(new OrderConfirmed($order));
        }


    }

    public function cancelOrder(Order $order){
        $order->status_order ="cancelled";
        $order->save();
    }
    public function shipOrder(Order $order){
        $order->status_order ="shipped";
        $order->save();
        event(new OrderShipped($order));
    }
    public function fraudOrder(Order $order){
        $order->status_order ="fraud";
        $order->save();
    }
}
