<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with(["messages", "views"])->where("user_id", Auth::id())->get();
        return view("admin.report.index", compact('apartments'));
    }

    public function show($slug)
    {
        $apartment =  Apartment::with(["messages", "views"])->where("slug", $slug)->where("user_id", Auth::id())->first();
        return view("admin.report.show", compact("apartment"));
    }
};
