<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($slug)
    {
        $apartment = Apartment::with(["messages"])->where("slug", $slug)->first();
        $messages = $apartment->messages;
        return view("admin.message.index", compact("messages"));
    }
}
