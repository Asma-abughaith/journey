<?php

namespace App\Interfaces\Gateways\Api\User;


interface PlanApiRepositoryInterface
{
    public function createPlan($validatedData);
    public function deletePlan($id);



}
