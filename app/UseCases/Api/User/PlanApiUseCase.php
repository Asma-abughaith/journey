<?php

namespace App\UseCases\Api\User;

use App\Interfaces\Gateways\Api\User\PlanApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\VolunteeringApiRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PlanApiUseCase
{
    protected $planRepository;

    public function __construct(PlanApiRepositoryInterface $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function createPlan($validatedData)
    {
        return $this->planRepository->createPlan($validatedData);
    }

    public function deletePlan($id)
    {
        return $this->planRepository->deletePlan($id);
    }






}
