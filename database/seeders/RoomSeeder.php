<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'user_one' => 1,
            'user_two' => 2,
        ]);

        Room::create([
            'user_one' => 1,
            'user_two' => 3,
        ]);
        
        Room::create([
            'user_one' => 2,
            'user_two' => 3,
        ]);
    }
}
