<?php

namespace App\Livewire;

use App\Models\Place;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PlanUpdate extends Component
{
    public $plan;
    public $name_en, $name_ar, $description_en, $description_ar, $places, $days = [];


    public function mount()
    {
        $this->places = Place::all();

        $planNames = $this->plan->getTranslations('name');
        $planDescription = $this->plan->getTranslations('description');

        $this->name_en = $planNames['en'];
        $this->name_ar = $planNames['ar'];
        $this->description_en = $planDescription['en'];
        $this->description_ar = $planDescription['ar'];

        $days = [];
        foreach ($this->plan->activities->groupBy('day_number') as $dayIndex => $activities) {
            --$dayIndex;
            foreach ($activities as $activityIndex => $activity) {
                $names = $activity->getTranslations('activity_name');
                $notes = $activity->getTranslations('notes');
                $this->days[$dayIndex]['activities'][$activityIndex]['place_id'] = $activity->place_id;
                $this->days[$dayIndex]['activities'][$activityIndex]['name_en'] = $names['en'];
                $this->days[$dayIndex]['activities'][$activityIndex]['name_ar'] = $names['ar'];
                $this->days[$dayIndex]['activities'][$activityIndex]['start_time'] = $activity->start_time;
                $this->days[$dayIndex]['activities'][$activityIndex]['end_time'] = $activity->end_time;
                $this->days[$dayIndex]['activities'][$activityIndex]['note_en'] = $notes['en'];
                $this->days[$dayIndex]['activities'][$activityIndex]['note_ar'] = $notes['ar'];
            }
        }
    }

    protected $rules = [
        'name_en' => 'required',
        'name_ar' => 'required',
        'description_en' => 'required',
        'description_ar' => 'required',
    ];

    public function addDay()
    {
        $this->days[] = [
            'activities' => [
                [
                    'name_en' => '',
                    'name_ar' => '',
                    'start_time' => '',
                    'end_time' => '',
                    'place_id' => '',
                    'note_en' => '',
                    'note_ar' => '',
                ]
            ]
        ];
        $this->updateValidationRules();
    }

    public function addActivity($dayIndex)
    {
        $this->days[$dayIndex]['activities'][] = [
            'name_en' => '',
            'name_ar' => '',
            'start_time' => '',
            'end_time' => '',
            'place_id' => '',
            'note_en' => '',
            'note_ar' => '',
        ];
        $this->updateValidationRules();
    }

    public function removeActivity($dayIndex, $activityIndex)
    {
        unset($this->days[$dayIndex]['activities'][$activityIndex]);
        $this->days[$dayIndex]['activities'] = array_values($this->days[$dayIndex]['activities']);
    }

    public function removeDay($dayIndex)
    {
        unset($this->days[$dayIndex]);
        $this->days = array_values($this->days);
    }

    protected function updateValidationRules()
    {
        $rules = $this->rules;
        foreach ($this->days as $dayIndex => $day) {
            foreach ($day['activities'] as $activityIndex => $activity) {
                $activityRule = "required";
                if ($activityIndex > 0) {
                    $previousEndTime = $this->days[$dayIndex]['activities'][$activityIndex - 1]['end_time'];
                    $activityRule .= "|after:$previousEndTime";
                }
                $rules["days.$dayIndex.activities.$activityIndex.name_en"] = "required";
                $rules["days.$dayIndex.activities.$activityIndex.name_ar"] = "required ";
                $rules["days.$dayIndex.activities.$activityIndex.start_time"] = $activityRule;
                $rules["days.$dayIndex.activities.$activityIndex.end_time"] = $activityRule . "|after:days.$dayIndex.activities.$activityIndex.start_time";
                $rules["days.$dayIndex.activities.$activityIndex.place_id"] = "required"."|exists:plans,id";
                $rules["days.$dayIndex.activities.$activityIndex.note_en"] = "max:255";
                $rules["days.$dayIndex.activities.$activityIndex.note_ar"] = "max:255";
            }
        }
        $this->rules = $rules;
    }

    public function messages()
    {
        return [
            'days.*.activities.*.note_en.max' => 'The note field cannot be longer than 255 characters.',
            'days.*.activities.*.note_ar.max' => 'The Arabic note field cannot be longer than 255 characters.',
            'days.*.activities.*.name_en.required' => 'The name field is required.',
            'days.*.activities.*.name_ar.required' => 'The Arabic name field is required.',
            'days.*.activities.*.place_id.required' => 'The Place field is required.',
            'days.*.activities.*.start_time.required' => 'The start time field is required.',
            'days.*.activities.*.start_time.date_format' => 'The start time must be in the format H:i.',
            'days.*.activities.*.start_time.after' => 'The start time must be after the end time of the previous activity.',
            'days.*.activities.*.end_time.required' => 'The end time field is required.',
            'days.*.activities.*.end_time.date_format' => 'The end time must be in the format H:i.',
            'days.*.activities.*.end_time.after' => 'The end time must be after the start time.',
        ];
    }

    public function submit()
    {
        $this->updateValidationRules();
        $this->validate($this->rules, [], $this->messages());

        $this->plan->activities()->delete();
        $this->plan->delete();

        $admin = Auth::guard('admin')->user();
        $translatorName = ['en' => $this->name_en, 'ar' => $this->name_ar];
        $translatorDescription = ['en' => $this->description_en, 'ar' => $this->description_ar];
        $newPlan = $admin->plans()->create(['name' => $translatorName, 'description' => $translatorDescription]);
        foreach ($this->days as $key => $day) {
            $dayNumber = ++$key;
            $activities = $day['activities'];
            foreach ($activities as $activity) {
                $translatorActivityName = ['en' => $activity['name_en'], 'ar' => $activity['name_ar']];
                $translatorActivityNote = ['en' => $activity['note_en'], 'ar' => $activity['note_ar']];
                $newPlan->activities()->create(['plan_id' => $newPlan->id, 'day_number' => $dayNumber, 'activity_name' => $translatorActivityName, 'start_time' => $activity['start_time'], 'end_time' => $activity['end_time'], 'place_id' => $activity['place_id'], 'notes' => $translatorActivityNote]);
            }
        }
        Toastr::success(__('validation.msg.plan-created-successfully!'), __('validation.msg.success'));
        return redirect()->route('admin.plans.index');
    }

    public function render()
    {
        return view('livewire.plan-update');
    }
}
