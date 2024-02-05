<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Models\Binary;
use App\Models\BonusBinary;
use App\Models\BonusDirectPurchase;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class GenealogyAddProductBonus
{
    const PV_GEN_LIMIT = 1000;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderConfirmed  $event
     * @return void
     */

    public function handle(OrderConfirmed $event)
    {
    Log::info('OrderConfirmed event.');
    Log::info('Order ID: '.$event->order->id);
    Log::info('Payment method: '.$event->order->payment_method );

        $order = $event->order;
        $owner = User::find($order->owner_id);
        if($order->payment_method =="welcomepack"){
            Log::info('Payment method is welcomepack');
        }elseif ($order->payment_method =="upgradepack"){
            Log::info('Payment method is upgradepack');
        }else{
            Log::info('Payment method is others');
            $orderItems = OrderItem::where('order_id',$order->id)
                ->with('product')
                ->get();
            foreach ($orderItems as $item){
                $pv_buyer    = $item->product->pv*floatval($item->qty);
                $pv_referral = $item->product->pv*floatval($item->qty);
                $description_buyer    = "Direct purchase PV earning for order: ".$order->orderRef;
                $description_referral = "Indirect purchase PV earning for order: ".$order->orderRef." ordered by: ".$owner->username;
                $this->addDirectPurchasePV($owner,$pv_buyer, $description_buyer, $order);
                // This was commented by me; Henry Abang on 28th, June, 2023
                // to stop product pv sharing to upline
                // $this->addUpdateUpLinkBinary($owner, $pv_referral, $description_referral);
                $this->debitInventory($item->product);
            }
        }

    }


    public function addDirectPurchasePV(User $user, $pv, $description, $order){
        $direct_bonus = new BonusDirectPurchase();
        $direct_bonus->user_id          = $user->id;
        $direct_bonus->pv               = $pv;
        $direct_bonus->date_time_earned = date("Y-m-d H:i:s");
        $direct_bonus->source           = "product_direct";
        $direct_bonus->status           = 0; // pending
        $direct_bonus->details          = $description;
        $direct_bonus->transaction_id   = $order->id;
        $direct_bonus->save();
        // update direct purchase on users column
        $user->current_direct_pv += $pv;
        $user->cumulative_direct_pv += $pv;
        $user->save();
    }


    public function addUpdateUpLinkBinary($user, $pv, $descriptionl){
        $username = $user->username;
        $referral_id = $user->id;
        $notFound = true;
        $counter=0;
        // counter to count pv generation
        $limitCounter = 0;

        while($notFound){
            $parent = $this->findParent($user);

            if($limitCounter >= self::PV_GEN_LIMIT){
                break;
            }

            if(!$parent){
                $notFound = false;
            }elseif($user->id == $parent->id){
                $notFound = false;   // end loop if found
            }else{
                // add referral pv
                if(floatval($pv)>0){
                    $binary_bonus = new BonusBinary();
                    $binary_bonus->user_id           = $parent->id;
                    $binary_bonus->referral_id       = $referral_id;
                    $binary_bonus->pv                = $pv;
                    $binary_bonus->date_time_earned  = date("Y-m-d H:i:s");
                    $binary_bonus->source           = "product_indirect";
                    $binary_bonus->status           = 0; // pending
                    $binary_bonus->details           = $descriptionl;
                    $binary_bonus->save();
                    // BonusBinary on users column
                    $parent->current_binary_pv += $pv;
                    $parent->cumulative_binary_pv += $pv;
                    $parent->save();
                }

                // update new user
                $user =$parent;
            }

            $limitCounter++;
        }
    }
    public function findParent(User $user){
        if(isset($user->parent)){
            $parent  = User::find($user->parent);
            return $parent;
        }
        return null;
    }

    //TODO inventory
    public function debitInventory($product){

    }

}
