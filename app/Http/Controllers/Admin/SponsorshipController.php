<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function index($slug)
    {
        $apartment = Apartment::with(["sponsorships"])->where("slug", $slug)->first();
        dd($apartment);
    }
}
