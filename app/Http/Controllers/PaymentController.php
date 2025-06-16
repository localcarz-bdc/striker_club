<?php

namespace App\Http\Controllers;

use App\Models\User;
use Omnipay\Omnipay;
use App\Models\Payment;
use App\Models\TmpInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $gateway;


    public function __construct(){
        $this->gateway = Omnipay::create('PayPal_Rest');
        
        if (env('PAYPAL_MODE') == 'live') {
            // Use live credentials and live mode
            $this->gateway->setClientId(env('PAYPAL_LIVE_CLIENT_ID'));
            $this->gateway->setSecret(env('PAYPAL_LIVE_CLIENT_SECRET'));
            $this->gateway->setTestMode(false);  // Live mode
        } else {
            // Use sandbox credentials and sandbox mode
            $this->gateway->setClientId(env('PAYPAL_SANDBOX_CLIENT_ID'));
            $this->gateway->setSecret(env('PAYPAL_SANDBOX_CLIENT_SECRET'));
            $this->gateway->setTestMode(true);   // Sandbox mode
        }
    }

    public function pay(Request $request)
    {


        $amount = intval(str_replace('$', '', $request->total));
        try{
            $response = $this->gateway->purchase(array(
                'amount' => $amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => route('success'),
                'cancelUrl' => route('fail'),
            ))->send();

            if($response->isRedirect()){
                $tmpInvoices = TmpInvoice::where('user_id', Auth::id())->where('status',0)->orderByDesc('id')->get();
                foreach ($tmpInvoices as $tmp) {
                    $tmp->status = 1;
                    $tmp->save();
                }

                $response->redirect();
            }else{
                return $response->getMessage();
            }
        }catch(\Throwable $th)
        {
            return $th->getMessage();

        }
    }


    public function success_message(Request $request)
    {
        if($request->input('paymentId') && $request->input('PayerID'))
        {

            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));
            $response = $transaction->send();

            if($response->isSuccessful()){
                $arr = $response->getData();

                $paypalamount =$arr['transactions'][0]['amount']['total'];

                $payerInfo['payer_id'] = $arr['payer']['payer_info']['payer_id'];
                $payerInfo['payer_email'] = $arr['payer']['payer_info']['email'];
                $payerInfo['transactions'] = $paypalamount;
                $payerInfo['currency'] = env('PAYPAL_CURRENCY');
                $payerInfo['status'] = $arr['state'];

                $user = User::find(Auth::user()->id);
                $username = $user->name ?? 'User';
                $paidtotal = $user->paid_balance + $paypalamount;
                $duetotal = $user->total_balance - $paidtotal;
                $user->paid_balance = $paidtotal;
                $user->due_balance = $duetotal;
                $user->save();

                $payment = new Payment();
                $payment->payment_id =$arr['id'];
                $payment->payer_id =$payerInfo['payer_id'];
                $payment->user_id = Auth::user()->id;
                $payment->payer_email = $payerInfo['payer_email'];
                $payment->amount = $paypalamount;
                $payment->currency =$payerInfo['currency'];
                $payment->pay_type ='paypal';
                $payment->pay_status ='Membership Fee';
                $payment->payment_status =$arr['state'];
                $payment->save();

                session()->flash('success', $username .' your payment is successful. Your id is '.$payerInfo['payer_id'].'  & transaction ID is: ' . $paypalamount);
                return redirect(route('member.invoice.list',Auth::user()->id));
                // return view('backend.success.success', $payerInfo);
            }else{
                return $response->getMessage();
            }
        }else{
            return response()->json(['error' => 'Payment is declined!']);
        }
    }

    public function fail_message()
    {
        return view('backend.fail.fail');
        // return response()->json(['error' => 'User decline the payment']);
    }
}
