<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\EventEntity;
use App\Interfaces\Gateways\Web\Admin\EventRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\PlanRepositoryInterface;
use App\Models\Event;
use App\Models\Plan;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

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
            $plan->activities()->sync([]);
            $plan->delete();
        }
        return;
    }



    protected function convertToEntity(Event $eloquentEvent)
    {
        $lang = getLang();
        $names = $eloquentEvent->getTranslations('name');
        $descriptions = $eloquentEvent->getTranslations('description');
        $addresses = $eloquentEvent->getTranslations('address');

        $event = new EventEntity();
        $event->setId($eloquentEvent->id);
        $event->setName($eloquentEvent->name);
        $event->setNameEn($names['en']);
        $event->setNameAr($names['ar']);
        $event->setDescription($eloquentEvent->description);
        $event->setDescriptionEn($descriptions['en']);
        $event->setDescriptionAr($descriptions['ar']);
        $event->setAddress($eloquentEvent->address);
        $event->setAddressEn($addresses['en']);
        $event->setAddressAr($addresses['ar']);
        $event->setRegion($eloquentEvent->region->name);
        $event->setOrganizers($eloquentEvent->organizers);
        $event->setPrice($eloquentEvent->price);
        $event->setStatus($eloquentEvent->status);
        $event->setLink($eloquentEvent->link);
        $event->setStartDatetime($eloquentEvent->start_datetime);
        $event->setEndDatetime($eloquentEvent->end_datetime);
        $event->setImage($eloquentEvent->getFirstMediaUrl('event', 'event_website'));
        return $event;
    }
}
