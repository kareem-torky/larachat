<?php

namespace App\Services;

use App\Models\Room;
use App\Events\PublicMessageSent;
use App\Events\PrivateMessageSent;
use App\Repositories\RoomRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Gate;
use App\Repositories\MessageRepository;
use Illuminate\Broadcasting\PrivateChannel;

class PrivateRoomService
{
    public function __construct(
        private UserRepository $userRepository,
        private MessageRepository $messageRepository,
        private RoomRepository $roomRepository,
    ){}

    public function authorize($room)
    {
        Gate::authorize('access-private-room', $room);
    }

    public function getLatestMessages($room, $num = 10)
    {
        return $this->messageRepository->getLatestPrivate($room->id, $num);
    }

    public function sendAndStore(Room $room, string $message)
    {
        $sender = $this->userRepository->getAuth();

        PrivateMessageSent::dispatch($room, $message, $sender);

        $this->messageRepository->store($message, $sender->id, $room->id);
    }

    public function getRecipientForAuthId($room)
    {
        return $room->getRecipientForAuthId();
    }

    public function getRecipientFor($room, $id)
    {
        return $room->getRecipientFor($id);
    }

    public function storeForAuthIdWith($id)
    {
        return $this->roomRepository->store([
            'user_one' => auth()->id(),
            'user_two' => $id,
        ]);
    }
}