<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\RegionEntity;

class RegionPresenter
{
    public function presentAllRegions($regions)
    {
        $formattedRegions = [];

        foreach ($regions as $region) {
            $formattedRegions[] = $this->formatRegion($region);
        }
        return $formattedRegions;
    }


    public function persentRegion($region)
    {
        return $this->formatRegion($region);
    }

    protected function formatRegion(RegionEntity $region)
    {
        return [
            'id' => $region->getId(),
            'name' => $region->getName(),
            'name_en' => $region->getNameEn(),
            'name_ar' => $region->getNameAr(),
        ];
    }

    public function presentAllRegionsForOthersControllers($regions){
        $formattedRegions = [];

        foreach ($regions as $region) {
            $formattedRegions[] = $this->formatRegionControllers($region);
        }
        return $formattedRegions;
    }

    protected function formatRegionControllers(RegionEntity $region)
    {
        return [
            'id' => $region->getId(),
            'name' => $region->getName(),
        ];
    }

}
