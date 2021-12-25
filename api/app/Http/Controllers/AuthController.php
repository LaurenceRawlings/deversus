<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Rules\AuthProviderRule;

class AuthController extends Controller
{
    /**
     * Redirect the user to the provider authentication page
     *
     * @param provider
     * @return JsonResponse
     */
    public function redirectToProvider($provider)
    {
        Validator::make(['provider' => $provider], [
            'provider' => [new AuthProviderRule],
        ])->validate();

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from the provider
     *s
     * @param provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider)
    {
        Validator::make(['provider' => $provider], [
            'provider' => [new AuthProviderRule],
        ])->validate();

        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials'], 422);
        }

        $userExists = User::where('email', $user->getEmail())->exists();

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getNickname(),
            ]
        );

        $providerCreated = $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );

        $token = $userCreated->createToken('auth-token')->plainTextToken;

        if ($userExists) {
            $userCreated->update([
                'avatar_provider_id' => $providerCreated->id
            ]);
        }

        return response()->json($userCreated, 200, ['Access-Token' => $token]);
    }
}
