<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Auth::user()->rooms();

        $users = User::where('id', '!=', auth()->id())
            ->whereNotIn('id', function($query) {
                $query->select('user_one')->from('rooms')->where('user_two', auth()->id());
            })->whereNotIn('id', function($query) {
                $query->select('user_two')->from('rooms')->where('user_one', auth()->id());
            })->get()->random(5);

        $data = [
            'rooms' => $rooms,
            'users' => $users,
        ];

        return view('home.index')->with($data);
    }
}
