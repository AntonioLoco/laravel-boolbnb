<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Category;
use App\Models\Service;
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

            // checking the range 
            if ($request->has("range")) {
                $range = $request->range;
            } else {
                $range = 20;
            }


            $apartments = Apartment::with(['services'])
                ->join('addresses', 'apartments.id', '=', 'addresses.apartment_id')
                ->selectRaw("apartments.*, ( 6371 * acos( cos( radians({$latitude}) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians({$longitude}) ) + sin( radians({$latitude}) ) * sin( radians( latitude ) ) ) ) AS distance")
                ->havingRaw("distance < {$range}");

            if ($request->has('rooms_number')) {
                $rooms_number = $request->rooms_number;
                $apartments = $apartments->where('rooms_number', '>=', $rooms_number);
            }

            if ($request->has('beds_number')) {
                $beds_number = $request->beds_number;
                $apartments = $apartments->where('beds_number', '=>', $beds_number);
            }

            if ($request->has('services')) {
                $services = $request->services;
                $apartments = $apartments->whereHas('services', function ($query) use ($services) {
                    $query->whereIn('id', $services);
                });
            }

            $apartments = $apartments->orderBy('distance')->get();
        } else {
            $apartments = Apartment::with(['services', 'address'])->get();
        }

        $categories = Category::all();

        $services = Service::all();

        return response()->json([
            "success" => true,
            "apartments" => $apartments,
            "categories" => $categories,
            'services' => $services
        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::with(['services', 'address'])->where('slug', $slug)->first();

        if ($apartment) {
            return response()->json([
                "success" => true,
                "apartment" => $apartment,
            ]);
        } else {
            return response()->json([
                'succes' => false,
                'error' => 'Niente da da fare non ho trovato niente'
            ]);
        }
    }
}
