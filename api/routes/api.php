<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Notifications\UserNotification;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $request->user()->notify(new UserNotification("Query User"));
    return $request->user();
});
