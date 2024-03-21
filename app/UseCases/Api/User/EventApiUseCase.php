<?php

namespace App\UseCases\Api\User;


use App\Interfaces\Gateways\Api\User\CategoryApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\EventApiRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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

    public function interestEvent($id)
    {
        $user_id = Auth::guard('api')->user()->id;
        $data=[
            'event_id'=>$id,
            'user_id'=>$user_id
        ];
        return $this->eventRepository->createInterestEvent($data);

    }

    public function disinterestEvent($id)
    {

        return $this->eventRepository->disinterestEvent($id);

    }

    public function favorite($id)
    {
        return $this->eventRepository->favorite($id);

    }

    public function deleteFavorite($id)
    {
        return $this->eventRepository->deleteFavorite($id);

    }



}
