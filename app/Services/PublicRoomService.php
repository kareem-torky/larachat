<?php

namespace App\Services;

use App\Events\PublicMessageSent;
use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;

class PublicRoomService
{
    public function __construct(private UserRepository $userRepository, private MessageRepository $messageRepository)
    {
    }

    public function getLatestMessages($num = 10)
    {
        return $this->messageRepository->getLatest($num);
    }

    public function sendAndStore(string $message)
    {
        $sender = $this->userRepository->getAuth();

        PublicMessageSent::dispatch($message, $sender);

        $this->messageRepository->store($message, $sender->id);
    }
}