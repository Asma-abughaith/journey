<?php

namespace App\UseCases\Web\Admin;

use App\Interfaces\Gateways\Web\Admin\FeatureRepositoryInterface;

class FeatureUseCase
{
    protected $featureRepository;

    public function __construct(FeatureRepositoryInterface $featureRepository)
    {
        $this->featureRepository = $featureRepository;
    }

    public function allFeatures()
    {
        return $this->featureRepository->getAllFeatures();
    }

    public function getFeature($feature)
    {
        return $this->featureRepository->getFeature($feature);
    }

    public function getFeatureById($featureId)
    {
        return $this->featureRepository->getFeatureById($featureId);
    }

    public function createFeature($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->featureRepository->createFeature(
            [
                'name' => $translator,
                'icon'=>$request['icon']
            ],
        );
    }

    public function updateFeature($feature, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->featureRepository->updateFeature(
            $feature,
            [
                'name' => $translator,
                'icon'=>$request['icon']
            ],
        );
    }

    public function deleteFeature($feature)
    {
        return $this->featureRepository->deleteFeature($feature);
    }

}
