<?php

namespace App\Http\Controllers;

use App\Services\PublicRoomService;
use App\Services\UserService;
use Illuminate\Http\Request;

class PublicRoomController extends Controller
{
    public function __construct(private PublicRoomService $publicRoomService,private UserService $userService)
    {
    }

    public function get()
    {
        $user = $this->userService->getAuth();
        $latestMessages = $this->publicRoomService->getLatestMessages();

        $data = [
            'user' => $user,
            'latestMessages' => $latestMessages,
        ];

        return view('rooms.public')->with($data);
    }

    public function send(Request $request)
    {
        $message = $request->message;
        $this->publicRoomService->sendAndStore($message);

        return response()->json('message sent successfully');
    }
}
