<?php

namespace App\Repositories\Web\Admin;


use App\Entities\Web\Admin\OrganizerEntity;
use App\Interfaces\Gateways\Web\Admin\OrganizerRepositoryInterface;
use App\Models\Organizer;
use Illuminate\Support\Str;


class EloquentOrganizerRepository implements OrganizerRepositoryInterface
{
    public function getAllOrganizers()
    {
        $eloquentOrganizers = Organizer::all();
        $organizers = [];

        foreach ($eloquentOrganizers as $eloquentOrganizer) {
            $organizers[] = $this->convertToEntity($eloquentOrganizer);
        }

        return $organizers;
    }

    public function  getOrganizer($organizer)
    {
        return $this->convertToEntity($organizer);
    }

    public function getOrganizerById($organizerId)
    {
        $eloquentOrganizer = Organizer::find($organizerId);

        return $eloquentOrganizer ? $this->convertToEntity($eloquentOrganizer) : null;
    }

    public function createOrganizer(array $organizerData, ?array $imageData)
    {
        if ($imageData === null || !isset($imageData['image']) || !$imageData['image'] instanceof \Illuminate\Http\UploadedFile || !$imageData['image']->isValid()) {
            throw new \InvalidArgumentException("Image data is required to create a category.");
        }

        $eloquentOrganizer = Organizer::create($organizerData);
        $eloquentOrganizer->setTranslations('name', $organizerData['name']);

        if ($imageData !== null) {
            $extension = pathinfo($imageData['image']->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $eloquentOrganizer->addMediaFromRequest('image')->usingFileName($filename)->toMediaCollection('organizer');
        }

        return $this->convertToEntity($eloquentOrganizer);
    }

    public function updateOrganizer($organizer, array $organizerData, array $imageData)
    {

        $organizer->update($organizerData);
        $organizer->setTranslations('name', $organizerData['name']);
        if (isset($imageData['image']) && $imageData['image'] != null) {
            $extension = pathinfo($imageData['image']->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $organizer->addMediaFromRequest('image')->usingFileName($filename)->toMediaCollection('organizer');
        }
        return $this->convertToEntity($organizer);
    }


    public function deleteOrganizer($organizer)
    {
        if ($organizer) {
            $organizer->delete();
        }
        return;
    }

    protected function convertToEntity(Organizer $eloquentOrganizer)
    {
        $names =$eloquentOrganizer->getTranslations('name');
        $organizer = new OrganizerEntity();
        $organizer->setId($eloquentOrganizer->id);
        $organizer->setName($eloquentOrganizer->name);
        $organizer->setNameEn($names['en']);
        $organizer->setNameAr($names['ar']);
        $organizer->setImage($eloquentOrganizer->getFirstMediaUrl('organizer', 'organizer_app'));
        return $organizer;
    }
}
