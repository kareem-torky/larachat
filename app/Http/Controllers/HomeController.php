<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private UserService $userService
    ){}

    public function index(Request $request)
    {
        $rooms = $this->userService->getAuthRooms();

        $users = $this->userService->getsearchResultsOrSuggestions($request->search);

        $data = [
            'rooms' => $rooms,
            'users' => $users,
            'search' => $request->search,
        ];

        return view('home.index')->with($data);
    }
}
