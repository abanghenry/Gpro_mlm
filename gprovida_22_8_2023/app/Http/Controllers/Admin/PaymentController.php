<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BonusDirectPurchase;
use App\Models\BonusReferral;
use App\Models\Currency;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{


    public function processPayment(Request $request){
        $rules = [
            'cid' => 'required',
        ];
        //TODO get Country from rquest
        $country = 'Nigeria';
        $currencyToPay = Currency::where('code','NGN')->first();

        $this->validate($request, $rules);
        $paymentsToMake = Payment::whereIn('id',$request->cid)
                                    ->with(['user.bank', 'currency'])
                                    ->where('status','!=','paid')
                                    ->get();

        $delimiter = ',';
        $counter   = 0;
        $today     = date('d/m/Y');
        $dateName  = date('d_M_Y');
        $time      =  time();
        $filename  ='payment_'.date("Y_m_d")."_".$time.'.csv';
        $filenamepath = '../storage/app/csvfile/'.$filename;
        $file=fopen($filenamepath,'w');
        $isZenith = $request->has('zenith');
        if($isZenith){
            $columns = array('S/N','BENEFICIARIES','AMOUNT','PAYMENT DATE','BENEFICIARY CODE','ACCOUNT NO','SORTCODES','DEBIT');
        }else{
            //TODO Payment for UBA BANK FORMAT
        // $columns = array('S/N','DEBIT_ACCOUNT_NUMBER','BENEFICIARY_NAME','BENEFICIARY_ACCOUNT',
        // 'BENEFICIARY_BANKCODE','CURRENCY','AMOUNT','TRANSACTION_DATE','FREQUENCY','NO_OF_PAYMENTS','NARRATION' );
        $columns = array(
                '#RECORDTYPE',
                'DEBIT_ACCOUNT_NUMBER',
                'BENEFICIARY_NAME',
                'BENEFICIARY_ACCOUNT',
                'BENEFICIARY_BANKCODE',
                'CURRENCY',
                'AMOUNT',
                'TRANSACTION_DATE',
                'FREQUENCY',
                'NO_OF_PAYMENTS',
                'NARRATION'
            );
        // $columns = array(
        //     '#RECORD_NUMBER',
        //     'BENEFICIARY_ACCOUNT',
        //     'BENEFICIARY_BANKCODE',
        //     'BENEFICIARY_NAME',
        //     'TRANSACTION_AMOUNT',
        //     'NARRATION'
        // );
        }
        
        fwrite($file, implode(',', $columns) . "\r\n");

        $datePaid = date("Y-m-d H:i:s");
        foreach ($paymentsToMake as $payment){
            $bank = $payment->user->bank;
            if((count($bank)>0) && ($bank[0]->country==$country) && ($payment->currency_id==$currencyToPay->id)){
                
                // get contributors(type) & mark as paid, add datetime paid
                if($payment->bonus_type=="referral" || $payment->bonus_type=="referral_stockist"){
                    BonusReferral::where('payment_id', $payment->id)->update(['status' => 2,'date_time_paid' =>$datePaid ]);
                }elseif($payment->bonus_type=="product_direct"){
                    BonusDirectPurchase::where('payment_id', $payment->id)->update(['status' => 2, 'date_time_paid' => $datePaid]);
                }else{

                }
                // change payment status to paid, add date paid
                $payment->status = 'paid';
                $payment->date_time_paid =date("Y-m-d H:i:s");
                $payment->save();

                // get the CSV Files
                $counter += 1;
                if($isZenith){
                    $debitAccount="1015380345"; // zenith bank account
                    $data = array(
                        $payment->id."_".$dateName.'_'.$counter,
                        $payment->user->firstname." ".$payment->user->lastname,
                        $payment->amount,
                        $today,
                        $payment->user->id,
                        count($bank)>0 ? $bank[0]->bank_account_number:"",
                        count($bank)>0 ? $bank[0]->sort_code:"",
                        $debitAccount
                    );
                }else{
                    $debitAccount="1026019821"; // uba bank account
                    $bankCode = count($bank)>0 ? $bank[0]->bank_code:"";
                    $recordType = empty($bankCode) ? '' : ($bankCode == '033' ? 'IFT' : 'NIP');
                    $data = array(
                        $recordType,
                        $debitAccount,
                        $payment->user->firstname." ".$payment->user->lastname,
                        count($bank)>0 ? $bank[0]->bank_account_number:"",
                        count($bank)>0 ? $bank[0]->bank_code:"",
                        'NGN',
                        $payment->amount,
                        $today,
                        'ONE_TIME',
                        1,
                        "GPro_".$payment->bonus_type,
                    );
                    // $data = array(
                    //     $counter,
                    //     count($bank)>0 ? $bank[0]->bank_account_number:"",
                    //     count($bank)>0 ? $bank[0]->bank_code:"",
                    //     $payment->user->firstname." ".$payment->user->lastname,
                    //     $payment->amount,
                    //     "GPro_".$payment->bonus_type,
                    // );
                }
                
                fwrite($file, implode(',', $data) . "\r\n");
            }else{
                // TODO pay other currencies
            }

        }
        fclose($file);
        return response()->download(storage_path('/app/csvfile/'. $filename));
    }


    public function payment(){
       $payments = Payment::with(['user.bank','currency'])->where('status','!=','paid')->orderBy('id', 'desc')->get();
       return view('admin.payment.index')->with([
           'pageTitle' => "Payment",
           'payments' => $payments,
       ]);
   }

    public function referral(){
        $payments = Payment::where('bonus_type','referral')->where('status','!=','paid')->with(['user.bank', 'currency'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Payment",
            'payments' => $payments,
        ]);
    }
    public function binary(){
        $payments = Payment::where('bonus_type','binary')->where('status','!=','paid')->with(['user.bank'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Payment",
            'payments' => $payments,
        ]);
    }
    public function award(){
        $payments = Payment::where('bonus_type','award')->where('status','!=','paid')->with(['user.bank'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Payment",
            'payments' => $payments,
        ]);
    }
    public function loyalty(){
        $payments = Payment::where('bonus_type','loyalty')->where('status','!=','paid')->with(['user.bank'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Payment",
            'payments' => $payments,
        ]);
    }
    public function directrepurchase(){
        $payments = Payment::where('bonus_type','direct')->where('status','!=','paid')->with(['user.bank'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Payment",
            'payments' => $payments,
        ]);
    }
    public function globalSales(){
        $payments = Payment::where('bonus_type','global')->where('status','!=','paid')->with(['user.bank'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Payment",
            'payments' => $payments,
        ]);
    }
    public function stockist(){
        $payments = Payment::where('bonus_type','stockist')->where('status','!=','paid')->with(['user.bank'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Payment",
            'payments' => $payments,
        ]);
    }
    public function referralStockist(){
        $payments = Payment::where('bonus_type','referral_stockist')->where('status','!=','paid')->with(['user.bank'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Payment",
            'payments' => $payments,
        ]);
    }
    public function special(){
        $payments = Payment::where('bonus_type','special')->where('status','!=','paid')->with(['user.bank'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Payment",
            'payments' => $payments,
        ]);
    }

    public function paidEarning(){
        $payments = Payment::where('status','paid')->with(['user.bank'])->orderBy('id', 'desc')->get();
        return view('admin.payment.index')->with([
            'pageTitle' => "Paid Earning",
            'payments' => $payments,
        ]);
    }


}
