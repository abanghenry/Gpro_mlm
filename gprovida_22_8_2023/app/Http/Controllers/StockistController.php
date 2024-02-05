<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StockistController extends Controller
{

    public function dashboard(Request $request){
        try {
            $store_id = Crypt::decryptString($request->id);
        }catch (\Exception $exception){
            return redirect('/dashboard')->with(['error'=>'Unknown Store']);
        }

        $store = Store::where('id',$store_id)
            //->where('user_id', Auth::user()->id)
            ->with('order.items','order.owner','order.currency')
            //->orderBy('order.id','desc')
            ->first();

        $unfiltered_transactions = $store->order;


        $processing_transactions = $unfiltered_transactions->filter(function ($value) {
            return $value->status_order == 'processing';
        });
        $shipped_transactions = $unfiltered_transactions->filter(function ($value) {
            return $value->status_order == 'shipped';
        });

        $process_and_shipped_transactions = $unfiltered_transactions->filter(function ($value) {
            return $value->status_order == 'processing' || $value->status_order == 'shipped';
        });

        $stockistPercentage = 5;

        $startThisMonth = date('Y-m-d H:i:s', strtotime('0:00 first day of this month'));
        $endThisMonth = date('Y-m-d H:i:s', strtotime('23:59 last day of this month'));

        $startThisWeek = date('Y-m-d H:i:s', strtotime('0:00 Last Sunday'));

        $startToday = date('Y-m-d H:i:s', strtotime('0:00 today'));
        $now =date('Y-m-d H:i:s');


        $totalEarning= $process_and_shipped_transactions->sum('net_total')*($stockistPercentage/100);
        $earningMonth  = $process_and_shipped_transactions->whereBetween('updated_at', [$startThisMonth, $endThisMonth])
                                    ->sum('net_total')*($stockistPercentage/100);
        $earningWeek  = $process_and_shipped_transactions->whereBetween('updated_at', [$startThisWeek, $now])
                ->sum('net_total')*($stockistPercentage/100);
        $earningToday  = $process_and_shipped_transactions->whereBetween('updated_at', [$startToday, $now])
                ->sum('net_total')*($stockistPercentage/100);


       $balanceEarning=0;



         $user = User::with('currency')->find(Auth::user()->id);
        return Inertia::render('Stockist/Dashboard', [
            'pageTitle' => "Dashboard",
            'user'=>$user,
            'latestDirectBonus'=>null,
            'transactions' => $process_and_shipped_transactions,
            'totalTransactions' => count($process_and_shipped_transactions),
            'totalTransactionsProcessing' => count($processing_transactions),
            'totalTransactionsShipped' => count($shipped_transactions),

            'earningToday' => $earningToday,
            'earningWeek' => $earningWeek,
            'earningMonth'=> $earningMonth,
            'totalEarning' => $totalEarning,
            'balanceEarning' => $balanceEarning,
        ]);

    }

    public function transactionView(Request $request){
        try {
            $order_id = Crypt::decryptString($request->id);
        }catch (\Exception $exception){
            return redirect('/dashboard')->with(['error'=>'Unknown Transaction']);
        }
        $transaction = Order::with('items','owner','user','currency', 'store')->find($order_id);
        return Inertia::render('Stockist/OrderDetails', [
            'pageTitle' => "Dashboard",
            'transaction' => $transaction
        ]);
    }


    public function shipOrder(Request $request){
        try {
            $order_id = Crypt::decryptString($request->id);
        }catch (\Exception $exception){
            return redirect('/dashboard')->with(['error'=>'Unknown Transaction']);
        }

        $order = Order::where('store_id',$request->store_id)->find($order_id);
        $storeId = Crypt::encryptString($request->store_id);
        if($order){
            $order->status_order ="shipped";
            $order->save();
            event(new OrderShipped($order));
            return redirect('stockist/'.$storeId)->with(['success'=>'Order Updated successfully' ]);
        }else{
            return redirect('stockist/'.$storeId)->with(['error'=>'Order Update failed' ]);
        }



    }

}
