<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function searchByName($keyword)
    {
        return User::where('name', 'like', "%$keyword%")->get();
    }

    public function getSuggestions($num = 5)
    {
        return User::where('id', '!=', auth()->id())
                ->whereNotIn('id', function($query) {
                    $query->select('user_one')->from('rooms')->where('user_two', auth()->id());
                })->whereNotIn('id', function($query) {
                    $query->select('user_two')->from('rooms')->where('user_one', auth()->id());
                })->get()->random($num);
    }

    public function getAuthRooms()
    {
        return auth()->user()->rooms();
    }
}