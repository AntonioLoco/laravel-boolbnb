<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has("address")) {
            $apartments = Apartment::query();

            if ($request->has("range")) {
                $apartments->where("Quello che mi seve");
            }

            if ($request->has("rooms_number")) {
                $apartments->where("Quello che mi seve");
            }

            if ($request->has("beds_number")) {
                $apartments->where("Quello che mi seve");
            }

            if ($request->has("services")) {
                $apartments->where("Quello che mi seve");
            }

            $apartments->get();

            return response()->json([
                "success" => true,
                "apartments" => $apartments
            ]);
        } else {
            $apartments = Apartment::all();
            return response()->json([
                "success" => true,
                "apartments" => $apartments
            ]);
        }
    }
}
