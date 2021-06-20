<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\PrivateRoomService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class PrivateRoomController extends Controller
{
    public function __construct(
        private PrivateRoomService $privateRoomService,
        private UserService $userService
    ){}

    public function start(User $user)
    {
        $room = $this->privateRoomService->storeForAuthIdWith($user->id);

        return redirect(route('room.private.get', $room->id));
    }

    public function get(Room $room)
    {
        $this->privateRoomService->authorize($room);
        $latestMessages = $this->privateRoomService->getLatestMessages($room);

        $user = $this->userService->getAuth();
        $recipient = $this->privateRoomService->getRecipientForAuthId($room);

        $data = [
            'room' => $room,
            'user' => $user,
            'recipient' => $recipient,
            'latestMessages' => $latestMessages,
        ];

        return view('rooms.private')->with($data);
    }

    public function send(Room $room, Request $request)
    {
        $message = $request->message;
        $this->privateRoomService->sendAndStore($room, $message);

        return response()->json('message sent successfully');
    }
}
