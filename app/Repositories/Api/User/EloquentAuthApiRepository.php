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

        if (isset($userData['username']) && isset($userData['password'])) {
            $credentials = [
                'username' => $userData['username'],
                'password' => $userData['password']
            ];
        } elseif (isset($userData['email']) && isset($userData['password'])) {
            $credentials = [
                'email' => $userData['email'],
                'password' => $userData['password']
            ];
        } else {
            return response()->json(['error' => 'Invalid credentials you should at least to enter username or email'], 400);
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
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
