<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Notifications\UserNotification;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);

    Route::get('/game', [GameController::class, 'index'])->name('game');
});
