<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "apartment_id" => "required",
            "fullname" => "required|max:255",
            "email" => "required",
            "message" => "required"
        ]);

        $newMessage = Message::create([
            "apartment_id" => $request->apartment_id,
            "fullname" => $request->fullname,
            "email" => $request->email,
            "message" => $request->message
        ]);

        return response()->json([
            "success" => true,
            "message" => "Messaggio inviato correttamente!"
        ]);
    }
}
