<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface RegionRepositoryInterface
{
    public function getAllRegions();

    public function getRegionById($regionId);

    public function getRegion($region);

    public function createRegion(array $regionData);

    public function updateRegion($region, array $regionData);

    public function deleteRegion($region);
}
