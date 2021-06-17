<?php

namespace App\Http\Controllers;

use App\Events\PublicMessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicRoomController extends Controller
{
    public function get()
    {
        $user = auth()->user();

        $data = [
            'user' => $user,
        ];

        return view('rooms.public')->with($data);
    }

    public function send(Request $request)
    {
        $message = $request->message;
        $sender = Auth::user();

        PublicMessageSent::dispatch($message, $sender);

        return response()->json('message sent successfully');
    }
}
