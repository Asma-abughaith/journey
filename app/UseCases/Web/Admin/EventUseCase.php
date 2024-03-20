<?php

namespace App\UseCases\Web\Admin;


use App\Interfaces\Gateways\Web\Admin\EventRepositoryInterface;

class EventUseCase
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function allEvents()
    {
        return $this->eventRepository->getAllEvents();
    }

    public function getEvent($event)
    {
        return $this->eventRepository->getEvent($event);
    }

    public function getEventById($eventId)
    {
        return $this->eventRepository->getEventById($eventId);
    }

    public function createEvent($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        $translatorDescription = ['en' => $request['description_en'], 'ar' => $request['description_ar']];
        $translatorAddress = ['en' => $request['address_en'], 'ar' => $request['address_ar']];


        return $this->eventRepository->createEvent(
            [
                'name' => $translator,
                'description' => $translatorDescription,
                'address' => $translatorAddress,
                'region_id' => $request['region_id'],
                'status'=> $request['status'],
                'link'=> $request['link'],
                'price'=> $request['price'],
                'start_datetime'=>$request['start_datetime'],
                'end_datetime'=>$request['end_datetime'],
                'attendance_number'=>$request['attendance_number']

            ],
            ['image' => isset($request['image']) ? $request['image'] : null],
            $request['organizers_id'],

        );
    }

    public function updateEvent($event, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        $translatorDescription = ['en' => $request['description_en'], 'ar' => $request['description_ar']];
        $translatorAddress = ['en' => $request['address_en'], 'ar' => $request['address_ar']];



        return $this->eventRepository->updateEvent(
            $event,
            [
                'name' => $translator,
                'description' => $translatorDescription,
                'address' => $translatorAddress,
                'region_id' => $request['region_id'],
                'status'=> $request['status'],
                'link'=> $request['link'],
                'price'=> $request['price'],
                'start_datetime'=>$request['start_datetime'],
                'end_datetime'=>$request['end_datetime'],
                'attendance_number'=>$request['attendance_number']
            ],
            ['image' => isset($request['image']) ? $request['image'] : null],
            $request['organizers_id'],

        );
    }

    public function deleteEvent($event)
    {
        return $this->eventRepository->deleteEvent($event);
    }


}
