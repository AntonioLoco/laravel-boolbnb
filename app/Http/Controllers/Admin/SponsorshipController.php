<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\DeleteSponsorJob;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $sponsorship = Sponsorship::where("id", $request->sponsorship_id)->first();
        $apartment = Apartment::where("id", $request->apartment_id)->first();

        $gateway = new Gateway([
            'environment' => getenv('BT_ENVIRONMENT'),
            'merchantId' => getenv('BT_MERCHANT_ID'),
            'publicKey' => getenv('BT_PUBLIC_KEY'),
            'privateKey' => getenv('BT_PRIVATE_KEY')
        ]);



        $amount = $sponsorship->price;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            "amount" => $amount,
            "paymentMethodNonce" => $nonce,
            'customer' => [
                'firstName' => Auth::user()->name,
                'lastName' => Auth::user()->lastname,
                'email' => Auth::user()->email
            ],
            "options" => [
                "submitForSettlement" => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction->id;

            $now = time();
            $secondsToAdd = $sponsorship->hours * (60 * 60);
            $end_date = $now + $secondsToAdd;

            $end_date = date("Y/m/d H:m:s", $end_date);

            $apartment->sponsorships()->attach($request->sponsorship_id, [
                'end_date' => $end_date,
                'is_active' => 1
            ]);

            $jobs = new DeleteSponsorJob($apartment, $request->sponsorship_id);
            dispatch($jobs->onConnection('database')->delay(now()->addSeconds($sponsorship->hours)));

            return redirect()->route("admin.payment.success", compact("transaction", "end_date"));
        } else {
            // $errorString = "";

            // foreach ($result->errors->deepAll() as $error) {
            //     $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            // }
            return redirect()->route("admin.payment.failed", compact("apartment"));
        }
    }
}
