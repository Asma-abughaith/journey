<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\AllCategoriesResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\SingleEventResource;
use App\Http\Resources\SingleVolunteeringResource;
use App\Http\Resources\VolunteeringResource;
use App\Interfaces\Gateways\Api\User\EventApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\PlanApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\VolunteeringApiRepositoryInterface;
use App\Models\Category;
use App\Models\Event;
use App\Models\Plan;
use App\Models\User;
use App\Models\Volunteering;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Psr\Log\NullLogger;


class EloquentPlanApiRepository implements PlanApiRepositoryInterface
{
    public function createPlan($validatedData)
    {
        // Create a new plan
        $plan = new Plan();
        $plan->name = json_encode(['en' => $validatedData['name'], 'ar' => $validatedData['name']]);
        $plan->description = json_encode(['en' => $validatedData['description'], 'ar' => $validatedData['description']]);
        $plan->creator_type = 'App\Models\User';
        $plan->creator_id = Auth::guard('api')->user()->id;
        $plan->save();

        // Iterate through days and activities to create them
        foreach ($validatedData['days'] as $index =>$day) {
            foreach ($day['activities'] as $activity) {
                $translatorName = json_encode(['en' => $activity['name'], 'ar' => $activity['name']]);
                $translatorNote = json_encode(['en' => $activity['note'], 'ar' => $activity['note']]);
                $plan->activities()->create([
                    'activity_name' => $translatorName,
                    'day_number'=>$index+1,
                    'start_time' => $activity['start_time'],
                    'end_time' => $activity['end_time'],
                    'place_id' => $activity['place_id'],
                    'notes' => $translatorNote ?? null,
                ]);
            }
        }

    }

    public function deletePlan($id)
    {
        $plan = Plan::find($id)->delete();
    }

}
