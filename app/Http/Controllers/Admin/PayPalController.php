<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function payment(Request $request)
    {
        // $price = $request->price;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" =>  "CAPTURE",
            "application_context" => [
                "return_url" =>  route('paypal_success'),
                "cancel_url" => route('paypal_cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" =>[
                        "currency_code" => "USD",
                        "value" => $request->price
                    ]

                ]
            ]
        ]);

        if(isset($response['id']) && $response['id'] != null)
        {
            foreach($response['links'] as $link)
            {
                if($link['rel'] === 'approve')
                {
                    return redirect()->away($link['href']);
                }
            }
        }else{
                    return redirect()->route('paypal_cancel');
        }

        // dd($response);
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if(isset($response['status']) && $response['status'] == 'COMPLETED')
        {
            return view('backend.payment.success');
            // return 'Payment is successfull!';
        }
        else{
            return redirect()->route('home');
            // return redirect()->route('paypal_cancel');
        }
        // dd($response);
    }

    public function cancel(Request $request)
    {
        return view('backend.payment.fail');
        // return 'Payment is cancelled!';
    }

    public function test()
    {
        return view('backend.payment.test_paypal');
    }
}
