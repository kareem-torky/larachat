<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicRoomController;
use App\Http\Controllers\PrivateRoomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::get('room/public', [PublicRoomController::class, 'get'])->name('room.public.get');
    Route::post('room/public/send', [PublicRoomController::class, 'send'])->name('room.public.send');

    Route::get('room/private/start/{user}', [PrivateRoomController::class, 'start'])->name('room.private.start');
    Route::get('room/private/{room}/', [PrivateRoomController::class, 'get'])->name('room.private.get');
    Route::post('room/private/{room}/send', [PrivateRoomController::class, 'send'])->name('room.private.send');

    // Route::get('test', function() {
    //     dd(App\Models\Room::find(1)->users());
    //     dd(App\Models\User::find(1)->rooms());
    // });
});