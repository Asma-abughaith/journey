<?php

namespace App\Repositories\Web\Admin;


use App\Entities\Web\Admin\VolunteeringEntity;
use App\Interfaces\Gateways\Web\Admin\VolunteeringRepositoryInterface;
use App\Models\Volunteering;
use Illuminate\Support\Str;

class EloquentVolunteeringRepository implements VolunteeringRepositoryInterface
{

    public function getAllVolunteerings()
    {
        $eloquentVolunteerings = Volunteering::with('region')->get();
        $volunteering = [];

        foreach ($eloquentVolunteerings as $eloquentVolunteering) {
            $volunteering[] = $this->convertToEntity($eloquentVolunteering);
        }

        return $volunteering;
    }

    public function getVolunteering($volunteering)
    {
        return $this->convertToEntity($volunteering);
    }

    public function getVolunteeringById($volunteeringId)
    {
        $eloquentVolunteering = Volunteering::find($volunteeringId);

        return $eloquentVolunteering ? $this->convertToEntity($eloquentVolunteering) : null;
    }

    public function createVolunteering($volunteeringData,  $imageData,  $organizers)
    {
        $eloquentVolunteering = Volunteering::create($volunteeringData);
        $eloquentVolunteering->setTranslations('name', $volunteeringData['name']);
        $eloquentVolunteering->setTranslations('description', $volunteeringData['description']);
        $eloquentVolunteering->setTranslations('address', $volunteeringData['address']);
        $eloquentVolunteering->organizers()->attach(array_values($organizers));


        if ($imageData !== null) {
            $extension = pathinfo($imageData['image']->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $eloquentVolunteering->addMediaFromRequest('image')->usingFileName($filename)->toMediaCollection('volunteering');
        }

        return $this->convertToEntity($eloquentVolunteering);
    }

    public function updateVolunteering($volunteering, $volunteeringData,  $imageData,  $organizers)
    {

        // ======================= General Information =======================
        $volunteering->update($volunteeringData);
        $volunteering->setTranslations('name', $volunteeringData['name']);
        $volunteering->setTranslations('description', $volunteeringData['description']);
        $volunteering->setTranslations('address', $volunteeringData['address']);

        // ======================= Image =======================
        if (isset($imageData['image']) && $imageData['image'] != null) {
            $extension = pathinfo($imageData['image']->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $volunteering->addMediaFromRequest('image')->usingFileName($filename)->toMediaCollection('volunteering');
        }

        // ======================= Organizers =======================
        $volunteering->organizers()->sync(array_values($organizers));

        return $this->convertToEntity($volunteering);
    }

    public function deleteVolunteering($volunteering)
    {
        if ($volunteering) {
            $volunteering->organizers()->sync([]);
            $volunteering->delete();
        }
        return;
    }



    protected function convertToEntity(Volunteering $eloquentVolunteering)
    {
        $lang = getLang();
        $names = $eloquentVolunteering->getTranslations('name');
        $descriptions = $eloquentVolunteering->getTranslations('description');
        $addresses = $eloquentVolunteering->getTranslations('address');

        $volunteering = new VolunteeringEntity();
        $volunteering->setId($eloquentVolunteering->id);
        $volunteering->setName($eloquentVolunteering->name);
        $volunteering->setNameEn($names['en']);
        $volunteering->setNameAr($names['ar']);
        $volunteering->setDescription($eloquentVolunteering->description);
        $volunteering->setDescriptionEn($descriptions['en']);
        $volunteering->setDescriptionAr($descriptions['ar']);
        $volunteering->setAddress($eloquentVolunteering->address);
        $volunteering->setAddressEn($addresses['en']);
        $volunteering->setAddressAr($addresses['ar']);
        $volunteering->setRegion($eloquentVolunteering->region->name);
        $volunteering->setOrganizers($eloquentVolunteering->organizers);
        $volunteering->setHoursWorked($eloquentVolunteering->hours_worked);
        $volunteering->setStatus($eloquentVolunteering->status);
        $volunteering->setLink($eloquentVolunteering->link);
        $volunteering->setStartDatetime($eloquentVolunteering->start_datetime);
        $volunteering->setEndDatetime($eloquentVolunteering->end_datetime);
        $volunteering->setAttendanceNumber($eloquentVolunteering->attendance_number);
        $volunteering->setImage($eloquentVolunteering->getFirstMediaUrl('volunteering', 'volunteering_website'));
        return $volunteering;
    }
}
