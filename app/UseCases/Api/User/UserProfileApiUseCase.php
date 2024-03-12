<?php

namespace App\UseCases\Api\User;


use App\Interfaces\Gateways\Api\User\UserProfileApiRepositoryInterface;

class UserProfileApiUseCase
{
    protected $userProfileRepository;

    public function __construct(UserProfileApiRepositoryInterface $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    public function allUserDetails()
    {
        return $this->userProfileRepository->getUserDetails();
    }


}
