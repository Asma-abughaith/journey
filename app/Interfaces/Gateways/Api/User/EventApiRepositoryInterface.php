<?php

namespace App\Interfaces\Gateways\Api\User;


interface EventApiRepositoryInterface
{
    public function getAllEvents();
    public function activeEvents();
    public function event($id);
    public function dateEvents($date);
    public function createInterestEvent($data);
    public function disinterestEvent($id);



}
