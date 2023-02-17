<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Braintree\Gateway;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function create($slug)
    {
        $apartment = Apartment::where("slug", $slug)->first();
        $sponsorships = Sponsorship::all();

        $gateway = new Gateway([
            'environment' => getenv('BT_ENVIRONMENT'),
            'merchantId' => getenv('BT_MERCHANT_ID'),
            'publicKey' => getenv('BT_PUBLIC_KEY'),
            'privateKey' => getenv('BT_PRIVATE_KEY')
        ]);

        $token = $gateway->clientToken()->generate();

        return view("admin.apartments.sponsorship.create", compact("apartment", "sponsorships", "token"));
    }

    public function checkout(Request $request)
    {

        $gateway = new Gateway([
            'environment' => getenv('BT_ENVIRONMENT'),
            'merchantId' => getenv('BT_MERCHANT_ID'),
            'publicKey' => getenv('BT_PUBLIC_KEY'),
            'privateKey' => getenv('BT_PRIVATE_KEY')
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            "amount" => $amount,
            "paymentMethodNonce" => $nonce,
            'customer' => [
                'firstName' => 'Tony', //Auth::user()->name
                'lastName' => 'Stark', //Auth::user()->lastname
                'email' => 'tony@avengers.com', //Auth::user()->email
            ],
            "options" => [
                "submitForSettlement" => true
            ]
        ]);

        // if ($result->success) {
        //     $transaction = $result->transaction;
        //     // return back()->with("success_message", "Tansaction successful with ID: $transaction->id ");
        //     return redirect()->route("payment.success")->with("message", "Transaction successful with ID: " . $transaction->id);
        // } else {
        //     $errorString = "";

        //     foreach ($result->errors->deepAll() as $error) {
        //         $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        //     }

        //     return back()->withErrors('An error occurred with the message: ' . $result->message);
        // }
    }
}
