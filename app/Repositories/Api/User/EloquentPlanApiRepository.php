<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\PlanResource;
use App\Http\Resources\SinglePlanResource;
use App\Interfaces\Gateways\Api\User\PlanApiRepositoryInterface;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class EloquentPlanApiRepository implements PlanApiRepositoryInterface
{
    public function allPlans()
    {
        $userId = Auth::guard('api')->user()->id;
        $plans = Plan::with('activities')
            ->where(function ($query) use ($userId) {
                $query->where('creator_type', 'App\Models\Admin')
                    ->orWhere(function ($query) use ($userId) {
                        $query->where('creator_type', 'App\Models\User')
                            ->where('creator_id', $userId);
                    });
            })->get();
        return PlanResource::collection($plans);
    }

    public function createPlan($validatedData)
    {
        $plan = new Plan();
        $plan->setTranslations('name', ['en' => $validatedData['name'], 'ar' => $validatedData['name']]);
        $plan->setTranslations('description', ['en' => $validatedData['description'], 'ar' => $validatedData['description']]);
        $plan->creator_type = 'App\Models\User';
        $plan->creator_id = Auth::guard('api')->user()->id;
        $plan->save();

        foreach ($validatedData['days'] as $index => $day) {
            foreach ($day['activities'] as $activityData) {
                $activity = $plan->activities()->create([
                    'activity_name' => $activityData['name'],
                    'day_number' => $index + 1,
                    'start_time' => $activityData['start_time'],
                    'end_time' => $activityData['end_time'],
                    'place_id' => $activityData['place_id'],
                    'notes' => $activityData['note'],
                ]);
                $activity->setTranslations('activity_name', ['en' => $activityData['name'], 'ar' => $activityData['name'],]);
                $activity->setTranslations('notes', ['en' => $activityData['note'], 'ar' => $activityData['note'],]);
                $activity->save();
            }
        }
    }

    public function updatePlan($validatedData)
    {
        $plan = Plan::find($validatedData['plan_id']);
        $plan->activities()->delete();

        $plan->update(['name' => $validatedData['name'], 'description' => $validatedData['description']]);
        $plan->setTranslations('name', ['ar' => $validatedData['name'], 'en' => $validatedData['name']]);
        $plan->setTranslations('description', ['ar' => $validatedData['description'], 'en' => $validatedData['description']]);
        $plan->save();

        foreach ($validatedData['days'] as $index => $day) {
            foreach ($day['activities'] as $activityData) {
                $activity = $plan->activities()->create([
                    'day_number' => $index + 1,
                    'activity_name' => $activityData['name'],
                    'start_time' => $activityData['start_time'],
                    'end_time' => $activityData['end_time'],
                    'place_id' => $activityData['place_id'],
                    'notes' => $activityData['note'] ?? null,
                ]);
                $activity->setTranslations('activity_name', ['en' => $activityData['name'], 'ar' => $activityData['name']]);
                $activity->setTranslations('notes', ['en' => $activityData['note'], 'ar' => $activityData['note']]);
                $activity->save();
            }
        }
    }


    public function deletePlan($id)
    {
        $plan = Plan::find($id)->delete();
    }

    public function show($id)
    {
        $plan = Plan::find($id);
        return new SinglePlanResource($plan);
    }
}
