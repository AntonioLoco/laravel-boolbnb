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

        $sponsorNum = 0;
        foreach ($apartment->sponsorships as $sponsor) {
            if ($sponsor->pivot->is_active) {
                $sponsorNum++;
            }
        }

        if ($sponsorNum === 0) {
            $sponsorships = Sponsorship::all();

            $gateway = new Gateway([
                'environment' => getenv('BT_ENVIRONMENT'),
                'merchantId' => getenv('BT_MERCHANT_ID'),
                'publicKey' => getenv('BT_PUBLIC_KEY'),
                'privateKey' => getenv('BT_PRIVATE_KEY'),
                'caFile' => getenv('BRAINTREE_SSL_CERT_PATH')
            ]);

            $token = $gateway->clientToken()->generate();

            return view("admin.apartments.sponsorship.create", compact("apartment", "sponsorships", "token"));
        } else {
            return redirect()->back();
        }
    }

    public function checkout(Request $request)
    {
        $request->validate([
            "sponsorship_id" => "required|exists:sponsorships,id",
            "apartment_id" => "required|exists:apartments,id"
        ], [
            "sponsorship_id.required" => "The sponsorship is invalid, please retry again!",
            "sponsorship_id.exists" => "The sponsorship is invalid, please retry again!",
        ]);

        $sponsorship = Sponsorship::where("id", $request->sponsorship_id)->first();
        $apartment = Apartment::where("id", $request->apartment_id)->first();

        $gateway = new Gateway([
            'environment' => getenv('BT_ENVIRONMENT'),
            'merchantId' => getenv('BT_MERCHANT_ID'),
            'publicKey' => getenv('BT_PUBLIC_KEY'),
            'privateKey' => getenv('BT_PRIVATE_KEY'),
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

            return view("admin.apartments.sponsorship.success", compact("transaction", "end_date"));
        } else {
            // $errorString = "";

            // foreach ($result->errors->deepAll() as $error) {
            //     $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            // }
            return view("admin.apartments.sponsorship.failed", compact("apartment"));
        }
    }
}
