<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface EventRepositoryInterface
{
    public function getAllEvents();

    public function getEventById($eventId);

    public function getEvent($event);

    public function createEvent($eventData,  $imageData,  $organizers);

    public function updateEvent($event, $eventData,  $imageData,  $organizers);

    public function deleteEvent($event);

}
