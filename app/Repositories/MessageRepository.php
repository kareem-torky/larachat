<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\User;

class MessageRepository
{
    public function getLatest($num)
    {
        return Message::where('room_id', null)->orderBy('id', 'DESC')->take($num)->get();
    }

    public function getLatestPrivate($room_id, $num)
    {
        return Message::where('room_id', $room_id)->orderBy('id', 'DESC')->take($num)->get();
    }

    public function store(string $message, $user_id, $room_id = null)
    {
        Message::create([
            'user_id' => $user_id,
            'content' => $message,
            'room_id' => $room_id
        ]);
    }
}