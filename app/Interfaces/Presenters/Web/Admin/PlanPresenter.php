<?php

namespace App\Interfaces\Presenters\Web\Admin;


use App\Entities\Web\Admin\PlaceEntity;
use App\Entities\Web\Admin\PlanEntity;

class PlanPresenter
{
    public function presentAllPlan($plans)
    {
        $formattedPlans = [];

        foreach ($plans as $plan) {
            $formattedPlans[] = $this->formatPlace($plan);
        }
        return $formattedPlans;
    }

    public function presentPlan($plan)
    {
        return $this->formatPlan($plan);
    }


    protected function formatPlan(PlanEntity $plan)
    {
        return [
            'id' => $plan->getId(),
            'name' => $plan->getName(),
            'name_en' => $plan->getNameEn(),
            'name_ar' => $plan->getNameAr(),
            'description' => $plan->getDescription(),
            'description_en' => $plan->getDescriptionEn(),
            'description_ar' => $plan->getDescriptionAr(),
            'creator'=>$plan->getCreator(),
            'activities' => $plan->getActivities()
        ];
    }
}
