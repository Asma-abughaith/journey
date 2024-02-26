<?php

namespace App\UseCases\Api\User;


use App\Interfaces\Gateways\Api\User\CategoryApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\EventApiRepositoryInterface;

class EventApiUseCase
{
    protected $eventRepository;

    public function __construct(EventApiRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function allEvents()
    {
        return $this->eventRepository->getAllEvents();
    }

    public function activeEvents()
    {
        return $this->eventRepository->activeEvents();
    }

    public function event($id)
    {
        return $this->eventRepository->event($id);
    }

    public function dateEvents($date)
    {
        return $this->eventRepository->dateEvents($date);
    }



}
