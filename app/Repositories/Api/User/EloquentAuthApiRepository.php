<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\AllCategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserLoginResource;
use App\Http\Resources\UserResource;
use App\Interfaces\Gateways\Api\User\AuthApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\CategoryApiRepositoryInterface;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EloquentAuthApiRepository implements AuthApiRepositoryInterface
{
    public function register($userData)
    {
        $user = User::create($userData);
        event(new Registered($user));
        return (new UserResource($user));
    }

    public function login($userData)
    {
        $credentials = [];

        if (isset($userData['usernameOrEmail']) && isset($userData['password'])) {
            $usernameOrEmail = $userData['usernameOrEmail'];
            $field = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $credentials = [
                $field => $usernameOrEmail,
                'password' => $userData['password']
            ];
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // CHeck If This User Verify Email
            if(!$user->hasVerifiedEmail())
                throw new \Exception(__('app.you-must-verify-your-email-first'));

            $token = $user->createToken('asma')->accessToken;
            $user->token = $token;
            return new UserLoginResource($user);
        } else {
            throw new \Exception('Invalid credentials.');
        }
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();
        $user->tokens()->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Successfully logged out']);
    }
}
