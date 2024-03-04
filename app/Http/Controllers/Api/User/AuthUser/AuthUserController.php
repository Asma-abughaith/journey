<?php

namespace App\Http\Controllers\Api\User\AuthUser;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\LoginApiUserRequest;
use App\Http\Requests\Api\User\Auth\RegisterApiUserRequest;
use App\Models\User;
use App\UseCases\Api\User\AuthApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    protected $authApiUseCase;

    public function __construct(AuthApiUseCase $authApiUseCase) {

        $this->authApiUseCase = $authApiUseCase;

    }

    public function register(RegisterApiUserRequest $request)
    {
        try {
            $user = $this->authApiUseCase->register($request->validated());
            return ApiResponse::sendResponse(200, 'user registered Successfully', $user);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }

    }

    public function login(LoginApiUserRequest $request)
    {
        try {
            $user = $this->authApiUseCase->login($request->validated());
            return ApiResponse::sendResponse(200, 'user logged in Successfully', $user);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }

    }
}
