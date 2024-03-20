<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\EventEntity;
use App\Interfaces\Gateways\Web\Admin\EventRepositoryInterface;
use App\Models\Event;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class EloquentEventRepository implements EventRepositoryInterface
{

    public function getAllEvents()
    {
        $eloquentEvents = Event::with('region')->get();
        $events = [];

        foreach ($eloquentEvents as $eloquentEvent) {
            $events[] = $this->convertToEntity($eloquentEvent);
        }

        return $events;
    }

    public function getEvent($event)
    {
        return $this->convertToEntity($event);
    }

    public function getEventById($eventId)
    {
        $eloquentEvent = Event::find($eventId);

        return $eloquentEvent ? $this->convertToEntity($eloquentEvent) : null;
    }

    public function createEvent($eventData,  $imageData,  $organizers)
    {
        $eloquentEvent = Event::create($eventData);
        $eloquentEvent->setTranslations('name', $eventData['name']);
        $eloquentEvent->setTranslations('description', $eventData['description']);
        $eloquentEvent->setTranslations('address', $eventData['address']);
        $eloquentEvent->organizers()->attach(array_values($organizers));


        if ($imageData !== null) {
            $extension = pathinfo($imageData['image']->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $eloquentEvent->addMediaFromRequest('image')->usingFileName($filename)->toMediaCollection('event');
        }

        return $this->convertToEntity($eloquentEvent);
    }

    public function updateEvent($event, $eventData,  $imageData,  $organizers)
    {

        // ======================= General Information =======================
        $event->update($eventData);
        $event->setTranslations('name', $eventData['name']);
        $event->setTranslations('description', $eventData['description']);
        $event->setTranslations('address', $eventData['address']);

        // ======================= Image =======================
        if (isset($imageData['image']) && $imageData['image'] != null) {
            $extension = pathinfo($imageData['image']->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $event->addMediaFromRequest('image')->usingFileName($filename)->toMediaCollection('event');
        }

        // ======================= Organizers =======================
        $event->organizers()->sync(array_values($organizers));

        return $this->convertToEntity($event);
    }

    public function deleteEvent($event)
    {
        if ($event) {
            $event->organizers()->sync([]);
            $event->delete();
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
        $event->setAttendanceNumber($eloquentEvent->attendance_number);
        $event->setImage($eloquentEvent->getFirstMediaUrl('event', 'event_website'));
        return $event;
    }
}
