<?php

namespace App\Interfaces\Presenters\Web\Admin;



use App\Entities\Web\Admin\VolunteeringEntity;

class VolunteeringPresenter
{
    public function presentAllVolunteerings($volunteerings)
    {
        $formattedVolunteerings = [];

        foreach ($volunteerings as $volunteering) {
            $formattedVolunteerings[] = $this->formatVolunteering($volunteering);
        }
        return $formattedVolunteerings;
    }

    public function presentVolunteering($volunteering)
    {
        return $this->formatVolunteering($volunteering);
    }


    protected function formatVolunteering(VolunteeringEntity $volunteering)
    {
        $status = $volunteering->getStatus()?"Active":'Inactive';
        return [
            'id' => $volunteering->getId(),
            'name' => $volunteering->getName(),
            'name_en' => $volunteering->getNameEn(),
            'name_ar' => $volunteering->getNameAr(),
            'description' => $volunteering->getDescription(),
            'description_en' => $volunteering->getDescriptionEn(),
            'description_ar' => $volunteering->getDescriptionAr(),
            'address' => $volunteering->getAddress(),
            'address_en' => $volunteering->getAddressEn(),
            'address_ar' => $volunteering->getAddressAr(),
            'region' => $volunteering->getRegion(),
            'image' => $volunteering->getImage(),
            'start_datetime'=>$volunteering->getStartDatetime(),
            'end_datetime'=>$volunteering->getEndDatetime(),
            'link'=>$volunteering->getLink(),
            'hours_worked'=>$volunteering->getHoursWorked(),
            'status'=>$status,
            'organizers'=>$volunteering->getOrganizers(),
            'attendance_number'=>$volunteering->getAttendanceNumber(),

        ];
    }
}
