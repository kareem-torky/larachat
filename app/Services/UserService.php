<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function getsearchResultsOrSuggestions($keyword)
    {
        return ($keyword == null) ? $this->userRepository->getSuggestions() : $this->userRepository->searchByName($keyword);
    }

    public function getAuthRooms()
    {
        return $this->userRepository->getAuthRooms();
    }
}