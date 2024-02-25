<?php

namespace App\UseCases\Web\Admin;

use App\Entities\Web\Admin\PermissionEntity;
use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\CategoryRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\OrganizerRepositoryInterface;

class OrganizerUseCase
{
    protected $organizerRepository;

    public function __construct(OrganizerRepositoryInterface $organizerRepository)
    {
        $this->organizerRepository = $organizerRepository;
    }

    public function allOrganizers()
    {
        return $this->organizerRepository->getAllOrganizers();
    }

    public function getOrganizer($organizer)
    {
        return $this->organizerRepository->getOrganizer($organizer);
    }

    public function getOrganizerById($organizerId)
    {
        return $this->organizerRepository->getOrganizerById($organizerId);
    }

    public function createOrganizer($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->organizerRepository->createOrganizer(
            [
                'name' => $translator,
            ],
            ['image' => isset($request['image']) ? $request['image'] : null]
        );
    }

    public function updateOrganizer($organizer, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->organizerRepository->updateOrganizer(
            $organizer,
            [
                'name' => $translator,
            ],
            ['image' => isset($request['image']) ? $request['image'] : null]
        );
    }

    public function deleteOrganizer($organizer)
    {
        return $this->organizerRepository->deleteOrganizer($organizer);
    }

}
