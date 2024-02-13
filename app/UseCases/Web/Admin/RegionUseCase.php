<?php

namespace App\UseCases\Web\Admin;

use App\Interfaces\Gateways\Web\Admin\RegionRepositoryInterface;

class RegionUseCase
{
    protected $regionRepository;

    public function __construct(RegionRepositoryInterface $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function allRegions()
    {
        return $this->regionRepository->getAllRegions();
    }

    public function getRegion($region)
    {
        return $this->regionRepository->getRegion($region);
    }

    public function getRegionById($regionId)
    {
        return $this->regionRepository->getRegionById($regionId);
    }

    public function createRegion($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->regionRepository->createRegion(
            [
                'name' => $translator,
            ],
        );
    }

    public function updateRegion($region, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->regionRepository->updateRegion(
            $region,
            [
                'name' => $translator,
            ],
        );
    }

    public function deleteRegion($region)
    {
        return $this->regionRepository->deleteRegion($region);
    }

}
