<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface OrganizerRepositoryInterface
{
    public function getAllOrganizers();

    public function getOrganizerById($organizerId);

    public function getOrganizer($organizer);

    public function createOrganizer(array $organizerData, array $imageData);

    public function updateOrganizer($organizer, array $organizerData, array $imageData);

    public function deleteOrganizer($organizer);
}
