<?php

namespace App\Interfaces\Presenters\Web\Admin;



use App\Entities\Web\Admin\EventEntity;

class EventPresenter
{
    public function presentAllEvents($events)
    {
        $formattedEvents = [];

        foreach ($events as $event) {
            $formattedEvents[] = $this->formatEvent($event);
        }
        return $formattedEvents;
    }

    public function presentEvent($event)
    {
        return $this->formatEvent($event);
    }


    protected function formatEvent(EventEntity $event)
    {
        $status = $event->getStatus()?"Active":'Inactive';
        return [
            'id' => $event->getId(),
            'name' => $event->getName(),
            'name_en' => $event->getNameEn(),
            'name_ar' => $event->getNameAr(),
            'description' => $event->getDescription(),
            'description_en' => $event->getDescriptionEn(),
            'description_ar' => $event->getDescriptionAr(),
            'address' => $event->getAddress(),
            'address_en' => $event->getAddressEn(),
            'address_ar' => $event->getAddressAr(),
            'region' => $event->getRegion(),
            'image' => $event->getImage(),
            'start_datetime'=>$event->getStartDatetime(),
            'end_datetime'=>$event->getEndDatetime(),
            'link'=>$event->getLink(),
            'price'=>$event->getPrice(),
            'status'=>$status,
            'organizers'=>$event->getOrganizers(),
        ];
    }
}
