<?php

namespace App\UseCases\Api\User;


use App\Interfaces\Gateways\Api\User\AuthApiRepositoryInterface;

class AuthApiUseCase
{
    protected $authRepository;

    public function __construct(AuthApiRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register($request, $lang)
    {
        $request['lang'] = $lang;
        return $this->authRepository->register($request, $lang);
    }

    public function login($request)
    {
        return $this->authRepository->login($request);
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }
}
