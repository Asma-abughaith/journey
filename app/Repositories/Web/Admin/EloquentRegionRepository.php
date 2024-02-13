<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\CategoryEntity;
use App\Entities\Web\Admin\RegionEntity;
use App\Interfaces\Gateways\Web\Admin\RegionRepositoryInterface;
use App\Models\Region;


class EloquentRegionRepository implements RegionRepositoryInterface
{
    public function getAllRegions()
    {
        $eloquentRegions = Region::all();
        $regions = [];

        foreach ($eloquentRegions as $eloquentRegion) {
            $regions[] = $this->convertToEntity($eloquentRegion);
        }

        return $regions;
    }

    public function getRegion($region)
    {
        return $this->convertToEntity($region);
    }

    public function getRegionById($regionId)
    {
        $eloquentRegion = Region::find($regionId);
        return $eloquentRegion ? $this->convertToEntity($eloquentRegion) : null;
    }

    public function createRegion(array $regionData)
    {
        $eloquentRegion = Region::create($regionData);
        $eloquentRegion->setTranslations('name', $regionData['name']);
        return $this->convertToEntity($eloquentRegion);
    }

    public function updateRegion($region, array $regionData)
    {
        $region->update($regionData);
        $region->setTranslations('name', $regionData['name']);
        return $this->convertToEntity($region);
    }


    public function deleteRegion($region)
    {
        if ($region) {
            $region->delete();
        }
        return;
    }

    protected function convertToEntity(Region $eloquentRegion)
    {
        $names =$eloquentRegion->getTranslations('name');
        $region = new RegionEntity();
        $region->setId($eloquentRegion->id);
        $region->setName($eloquentRegion->name);
        $region->setNameEn($names['en']);
        $region->setNameAr($names['ar']);
        return $region;
    }
}
