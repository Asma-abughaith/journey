<?php

namespace App\Interfaces\Gateways\Api\User;


interface PlanApiRepositoryInterface
{
    public function allPlans();
    public function createPlan($validatedData);
    public function updatePlan($validatedData);
    public function deletePlan($id);




}
