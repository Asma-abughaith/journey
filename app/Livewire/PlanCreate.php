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
        'days.*.activities.*.name_en' => 'required',
        'days.*.activities.*.name_ar' => 'required',
        'days.*.activities.*.start_datetime' => 'required|date_format:H:i',
        'days.*.activities.*.end_datetime' => 'required|date_format:H:i|after:days.*.activities.*.start_datetime',
        'days.*.activities.*.places' => 'required|array',
        'days.*.activities.*.note_en' => 'required',
        'days.*.activities.*.note_ar' => 'required',
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
                    'places' => [],
                    'note_en' => '',
                    'note_ar' => '',
                ]
            ]
        ];
    }

    public function addActivity($dayIndex)
    {
        $this->days[$dayIndex]['activities'][] = [
            'name_en' => '',
            'name_ar' => '',
            'start_datetime' => '',
            'end_datetime' => '',
            'places' => [],
            'note_en' => '',
            'note_ar' => '',
        ];
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

    public function submit()
    {
        $this->validate();
        dd($this->validate());

        // Do something with the submitted data
        // Example: Saving to the database
        // Plan::create([...]);

        session()->flash('message', 'Plan created successfully!');
    }

    public function render()
    {
        return view('livewire.plan-create');
    }
}
