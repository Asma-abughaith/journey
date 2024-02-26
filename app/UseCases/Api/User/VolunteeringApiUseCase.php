<?php

namespace App\UseCases\Api\User;

use App\Interfaces\Gateways\Api\User\VolunteeringApiRepositoryInterface;

class VolunteeringApiUseCase
{
    protected $volunteeringRepository;

    public function __construct(VolunteeringApiRepositoryInterface $volunteeringRepository)
    {
        $this->volunteeringRepository = $volunteeringRepository;
    }

    public function allVolunteerings()
    {
        return $this->volunteeringRepository->getAllVolunteerings();
    }

    public function activeVolunteerings()
    {
        return $this->volunteeringRepository->activeVolunteerings();
    }

    public function Volunteering($id)
    {
        return $this->volunteeringRepository->volunteering($id);
    }

    public function dateVolunteerings($date)
    {
        return $this->volunteeringRepository->dateVolunteerings($date);
    }



}
