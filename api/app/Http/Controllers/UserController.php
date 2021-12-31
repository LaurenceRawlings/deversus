<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $user->forceFill(['ip' => $request->ip()])->save();
        return $user;
    }
}
