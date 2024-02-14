<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface FeatureRepositoryInterface
{
    public function getAllFeatures();

    public function getFeatureById($featureId);

    public function getFeature($feature);

    public function createFeature(array $featureData);

    public function updateFeature($feature, array $featureData);

    public function deleteFeature($feature);
}
