<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface PlanRepositoryInterface
{
    public function getAllPlans();

    public function getPlanById($planId);

    public function getPlan($plan);

    public function createPlan($planData, $activities);

    public function updatePlan($plan,$planData, $activities);

    public function deletePlan($plan);

}
