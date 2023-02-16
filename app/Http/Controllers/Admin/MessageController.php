<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($slug)
    {
        $apartment = Apartment::with(["messages"])->where("slug", $slug)->first();

        if (Auth::id() == $apartment->user_id) {
            $messages = $apartment->messages;
            return view("admin.message.index", compact("messages", "apartment"));
        } else {
            $message = "Non sei autorizzato a visualizzare i messaggi di questo appartamento";
            return view("admin.notAllowed", compact("message"));
        }
    }
}
