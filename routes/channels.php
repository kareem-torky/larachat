<?php

use App\Models\Room;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('public-room', function ($user) {
    $isLoggedIn = ($user != null);

    return $isLoggedIn;
});

Broadcast::channel('private-room-{roomId}', function ($user, $roomId) {
    $isLoggedIn = ($user != null);
    $isRoomUser = Room::find($roomId)->hasUser($user->id);

    return ($isLoggedIn and $isRoomUser);
});