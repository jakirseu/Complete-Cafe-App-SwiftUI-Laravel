<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function showPaymentSheet(Request $request)
    {

        // get the latest docs from here:
        // https://docs.stripe.com/payments/accept-a-payment?platform=ios&lang=php


        $request->validate([
            'total' => 'required',

        ]);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // Use an existing Customer ID if this is a returning customer.
        $customer = $stripe->customers->create();
        $ephemeralKey = $stripe->ephemeralKeys->create([
          'customer' => $customer->id,
        ], [
          'stripe_version' => '2023-08-16',
        ]);

        $paymentIntent = $stripe->paymentIntents->create([
          'amount' =>  $request->input('total') * 100,
          'currency' => 'usd',
          'customer' => $customer->id,
          // In the latest version of the API, specifying the `automatic_payment_methods` parameter
          // is optional because Stripe enables its functionality by default.
          'automatic_payment_methods' => [
            'enabled' => 'true',
          ],
        ]);

        echo json_encode(
          [
            'paymentIntent' => $paymentIntent->client_secret,
            'ephemeralKey' => $ephemeralKey->secret,
            'customer' => $customer->id,
            'publishableKey' => env('STRIPE_PUBLISHED')
          ]
        );
        http_response_code(200);

    }
}
