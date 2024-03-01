<?php

namespace App\Livewire;

use App\Models\Place;
use Livewire\Component;

class PlanCreate extends Component
{
    public $name_en, $name_ar, $description_en, $description_ar, $places, $days = [];

    protected $rules = [
        'name_en' => 'required',
        'name_ar' => 'required',
        'description_en' => 'required',
        'description_ar' => 'required',
    ];

    public function mount()
    {
        $this->places = Place::all();
        $this->addDay();
    }

    public function addDay()
    {
        $this->days[] = [
            'activities' => [
                [
                    'name_en' => '',
                    'name_ar' => '',
                    'start_datetime' => '',
                    'end_datetime' => '',
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
            'start_datetime' => '',
            'end_datetime' => '',
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
        $this->updateValidationRules();
    }

    public function removeDay($dayIndex)
    {
        unset($this->days[$dayIndex]);
        $this->days = array_values($this->days);
        $this->updateValidationRules();
    }

    public function updated($propertyName)
    {
        // If start_datetime or end_datetime of any activity is updated, update validation rules
        if (strpos($propertyName, 'start_datetime') !== false || strpos($propertyName, 'end_datetime') !== false) {
            $this->updateValidationRules();
        }
    }

    protected function updateValidationRules()
    {
        $rules = $this->rules;
        foreach ($this->days as $dayIndex => $day) {
            foreach ($day['activities'] as $activityIndex => $activity) {
                $activityRule = "required|date_format:H:i";
                if ($activityIndex > 0) {
                    // Ensure start time is after end time of previous activity
                    $previousEndTime = $this->days[$dayIndex]['activities'][$activityIndex - 1]['end_datetime'];
                    $activityRule .= "|after:$previousEndTime";
                }
                $rules["days.$dayIndex.activities.$activityIndex.start_datetime"] = $activityRule;
                $rules["days.$dayIndex.activities.$activityIndex.end_datetime"] = $activityRule;
            }
        }
        $this->rules = $rules;
    }

    public function submit()
    {

        $this->validate();

        // Perform submission logic
        // For demonstration, just dump the validated data

        // After submission logic, you may want to redirect or show a success message
        session()->flash('message', 'Plan created successfully!');
        return redirect()->to('/'); // Redirect to desired page
    }

    public function render()
    {
        return view('livewire.plan-create');
    }
}
