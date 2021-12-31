<?php

namespace App\Http\Controllers;

use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        $publicGame = Game::where('code', config('public_game_code'))->with('users')->first();

        if (!$publicGame) {
            $publicGame = Game::create([
                'code' => config('public_game_code'),
            ])->save();
        }

        return response()->json([
            'public_game' => $publicGame,
        ]);
    }
}
