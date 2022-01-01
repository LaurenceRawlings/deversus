<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $publicGame = Game::where('code', config('services.extension.public_game_code'))->with('users')->first();

        if (!$publicGame) {
            $publicGame = Game::create([
                'code' => config('services.extension.public_game_code'),
            ]);
        }

        return $publicGame;
    }

    public function join(Request $request)
    {
        $game = Game::where('code', $request->code)->with('users')->firstOrFail();

        $game->users()->attach(auth()->user());

        return $game->refresh();
    }
}
