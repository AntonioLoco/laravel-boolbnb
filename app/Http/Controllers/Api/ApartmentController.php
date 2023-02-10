<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has("address")) {
            //Chiamo api tomtom per latitudine e longitudine dell'indirizzo della ricerca
            $address = $request->address;
            $urlTomTom = "https://api.tomtom.com/search/2/geocode/" . $address . ".json?key=QEZMPbAxyM5B51twR2BRzWuWxSUDiBYg";
            $response = Http::withOptions(['verify' => false])->get($urlTomTom);
            $data = json_decode($response->body(), true);

            //Setto latitudie e longitudine
            $latitude = $data["results"][0]["position"]["lat"];
            $longitude = $data["results"][0]["position"]["lon"];

            if ($request->has("range")) {
                $range = $request->range;
            } else {
                $range = 20;
            }


            $apartments = Apartment::with(['services'])
                ->join('addresses', 'apartments.id', '=', 'addresses.apartment_id')
                ->selectRaw("apartments.*, ( 6371 * acos( cos( radians({$latitude}) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians({$longitude}) ) + sin( radians({$latitude}) ) * sin( radians( latitude ) ) ) ) AS distance")
                ->havingRaw("distance < {$range}")->get();
        } else {
            $apartments = Apartment::with(['services']);
        }

        $categories = Category::all();

        return response()->json([
            "success" => true,
            "apartments" => $apartments,
            "categories" => $categories
        ]);
    }
}
