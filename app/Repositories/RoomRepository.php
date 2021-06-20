<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\User;
use App\Models\Message;

class RoomRepository
{
    public function store($userIds)
    {
        return Room::create([
            'user_one' => $userIds['user_one'],
            'user_two' => $userIds['user_two'],
        ]);
    }
}