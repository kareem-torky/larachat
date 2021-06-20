<?php

namespace App\Services;

use App\Events\PublicMessageSent;
use App\Repositories\UserRepository;

class PublicRoomService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function sendAndStore(string $message)
    {
        $sender = $this->userRepository->getAuth();

        PublicMessageSent::dispatch($message, $sender);

        // TODO: store in db
    }
}