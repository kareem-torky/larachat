<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Events\PrivateMessageSent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PrivateRoomController extends Controller
{
    public function start(User $user)
    {
        $room = Room::create([
            'user_one' => Auth::id(),
            'user_two' => $user->id,
        ]);

        return redirect(route('room.private.get', $room->id));
    }

    public function get(Room $room)
    {
        Gate::authorize('access-private-room', $room);

        $user = auth()->user();
        $recipient = $room->getRecipientForAuthId();

        $data = [
            'room' => $room,
            'user' => $user,
            'recipient' => $recipient,
        ];

        return view('rooms.private')->with($data);
    }

    public function send(Room $room, Request $request)
    {
        $message = $request->message;
        $sender = Auth::user();

        PrivateMessageSent::dispatch($room, $message, $sender);

        return response()->json('message sent successfully');
    }
}
