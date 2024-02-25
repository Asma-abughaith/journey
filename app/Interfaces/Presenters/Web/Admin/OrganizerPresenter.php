<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\OrganizerEntity;

class OrganizerPresenter
{
    public function presentAllOrganizers($organizers)
    {
        $formattedOrganizers = [];

        foreach ($organizers as $organizer) {
            $formattedOrganizers[] = $this->formatOrganizer($organizer);
        }
        return $formattedOrganizers;
    }

    public function presentAllOrganizersForAnotherController($organizers)
    {
        $formattedOrganizers = [];

        foreach ($organizers as $organizer) {
            $formattedOrganizers[] = $this->formatOrganizersForAnotherController($organizer);
        }
        return $formattedOrganizers;
    }

    public function persentOrganizer($organizer)
    {
        return $this->formatOrganizer($organizer);
    }

    protected function formatOrganizer(OrganizerEntity $organizer)
    {
        return [
            'id' => $organizer->getId(),
            'name' => $organizer->getName(),
            'name_en' => $organizer->getNameEn(),
            'name_ar' => $organizer->getNameAr(),
            'image' => $organizer->getImage(),
        ];
    }

    protected function formatOrganizersForAnotherController(OrganizerEntity $organizer)
    {
        $lang = app()->getLocale();
        $nameLang = 'getName' . ucfirst($lang);
        return [
            'id' => $organizer->getId(),
            'name' => $organizer->$nameLang(),
        ];
    }
}
