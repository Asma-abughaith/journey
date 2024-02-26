<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface VolunteeringRepositoryInterface
{
    public function getAllVolunteerings();

    public function getVolunteeringById($volunteeringId);

    public function getVolunteering($volunteering);

    public function createVolunteering($volunteeringData,  $imageData,  $organizers);

    public function updateVolunteering($volunteering, $volunteeringData,  $imageData,  $organizers);

    public function deleteVolunteering($volunteering);

}
