<?php

namespace App\UseCases\Web\Admin;


use App\Interfaces\Gateways\Web\Admin\EventRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\VolunteeringRepositoryInterface;

class VolunteeringUseCase
{
    protected $volunteeringRepository;

    public function __construct(VolunteeringRepositoryInterface $volunteeringRepository)
    {
        $this->volunteeringRepository = $volunteeringRepository;
    }

    public function allVolunteerings()
    {
        return $this->volunteeringRepository->getAllVolunteerings();
    }

    public function getVolunteering($volunteering)
    {
        return $this->volunteeringRepository->getVolunteering($volunteering);
    }

    public function getVolunteeringById($volunteeringId)
    {
        return $this->volunteeringRepository->getVolunteeringById($volunteeringId);
    }

    public function createVolunteering($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        $translatorDescription = ['en' => $request['description_en'], 'ar' => $request['description_ar']];
        $translatorAddress = ['en' => $request['address_en'], 'ar' => $request['address_ar']];


        return $this->volunteeringRepository->createVolunteering(
            [
                'name' => $translator,
                'description' => $translatorDescription,
                'address' => $translatorAddress,
                'region_id' => $request['region_id'],
                'status'=> $request['status'],
                'link'=> $request['link'],
                'hours_worked'=> $request['hours_worked'],
                'start_datetime'=>$request['start_datetime'],
                'end_datetime'=>$request['end_datetime'],
                'attendance_number'=>$request['attendance_number']

            ],
            ['image' => isset($request['image']) ? $request['image'] : null],
            $request['organizers_id'],

        );
    }

    public function updateVolunteering($event, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        $translatorDescription = ['en' => $request['description_en'], 'ar' => $request['description_ar']];
        $translatorAddress = ['en' => $request['address_en'], 'ar' => $request['address_ar']];



        return $this->volunteeringRepository->updateVolunteering(
            $event,
            [
                'name' => $translator,
                'description' => $translatorDescription,
                'address' => $translatorAddress,
                'region_id' => $request['region_id'],
                'status'=> $request['status'],
                'link'=> $request['link'],
                'hours_worked'=> $request['hours_worked'],
                'start_datetime'=>$request['start_datetime'],
                'end_datetime'=>$request['end_datetime'],
                'attendance_number'=>$request['attendance_number']
            ],
            ['image' => isset($request['image']) ? $request['image'] : null],
            $request['organizers_id'],

        );
    }

    public function deleteVolunteering($event)
    {
        return $this->volunteeringRepository->deleteVolunteering($event);
    }


}
