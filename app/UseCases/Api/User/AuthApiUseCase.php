<?php

namespace App\UseCases\Api\User;


use App\Interfaces\Gateways\Api\User\AuthApiRepositoryInterface;

class AuthApiUseCase
{
    protected $AuthRepository;

    public function __construct(AuthApiRepositoryInterface $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
    }

    public function register($request)
    {
        return $this->AuthRepository->register($request);
    }

    public function login($request)
    {
        return $this->AuthRepository->login($request);
    }



}
