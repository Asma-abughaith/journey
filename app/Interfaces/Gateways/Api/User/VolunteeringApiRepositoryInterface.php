<?php

namespace App\Interfaces\Gateways\Api\User;


interface VolunteeringApiRepositoryInterface
{
    public function getAllVolunteerings();
    public function activeVolunteerings();
    public function volunteering($id);
    public function dateVolunteerings($date);
    public function createInterestVolunteering($data);
    public function disinterestVolunteering($id);
    public function favorite($id);
    public function deleteFavorite($id);



}
