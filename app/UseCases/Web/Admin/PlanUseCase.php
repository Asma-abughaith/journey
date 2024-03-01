<?php

namespace App\UseCases\Web\Admin;


use App\Interfaces\Gateways\Web\Admin\PlanRepositoryInterface;

class PlanUseCase
{
    protected $planRepository;

    public function __construct(PlanRepositoryInterface $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function getAllPlans()
    {
        return $this->planRepository->getAllPlans();
    }

    public function getPlan($plan)
    {
        return $this->planRepository->getPlan($plan);
    }

    public function getPlanById($planId)
    {
        return $this->planRepository->getPlanById($planId);
    }

    public function createPlan($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        $translatorDescription = ['en' => $request['description_en'], 'ar' => $request['description_ar']];


        return $this->planRepository->createPlan(
            [
                'name' => $translator,
                'description' => $translatorDescription,

            ],
            $request['activities'],

        );
    }

    public function updatePlan($plan, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        $translatorDescription = ['en' => $request['description_en'], 'ar' => $request['description_ar']];



        return $this->planRepository->updatePlan(
            $plan,
            [
                'name' => $translator,
                'description' => $translatorDescription,
            ],
            $request['activities'],

        );
    }

    public function deletePlan($plan)
    {
        return $this->planRepository->deletePlan($plan);
    }
}
