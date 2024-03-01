<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\PlanEntity;
use App\Interfaces\Gateways\Web\Admin\PlanRepositoryInterface;
use App\Models\Plan;

class EloquentPlanRepository implements PlanRepositoryInterface
{

    public function getAllPlans()
    {
        $eloquentPlans = Plan::with('activities')->get();
        $plans = [];

        foreach ($eloquentPlans as $eloquentPlan) {
            $plans[] = $this->convertToEntity($eloquentPlan);
        }

        return $plans;
    }

    public function getPlan($plan)
    {
        return $this->convertToEntity($plan);
    }

    public function getPlanById($planId)
    {
        $eloquentPlan = Plan::find($planId);

        return $eloquentPlan ? $this->convertToEntity($eloquentPlan) : null;
    }

    public function createPlan($planData, $activities)
    {
        $eloquentPlan = Plan::create($planData);
        $eloquentPlan->setTranslations('name', $planData['name']);
        $eloquentPlan->setTranslations('description', $planData['description']);
        $eloquentPlan->activities()->attach(array_values($activities));

        return $this->convertToEntity($eloquentPlan);
    }

    public function updatePlan($plan, $planData, $activities)
    {

        // ======================= General Information =======================
        $plan->update($planData);
        $plan->setTranslations('name', $planData['name']);
        $plan->setTranslations('description', $planData['description']);

        $plan->activities()->sync(array_values($activities));

        return $this->convertToEntity($plan);
    }

    public function deletePlan($plan)
    {
        if ($plan) {
            $plan->activities()->delete();
            $plan->delete();
        }
        return;
    }



    protected function convertToEntity(Plan $eloquentEvent)
    {
        $names = $eloquentEvent->getTranslations('name');
        $descriptions = $eloquentEvent->getTranslations('description');

        $event = new PlanEntity();
        $event->setId($eloquentEvent->id);
        $event->setName($eloquentEvent->name);
        $event->setNameEn($names['en']);
        $event->setNameAr($names['ar']);
        $event->setDescription($eloquentEvent->description);
        $event->setDescriptionEn($descriptions['en']);
        $event->setDescriptionAr($descriptions['ar']);
        return $event;
    }
}
