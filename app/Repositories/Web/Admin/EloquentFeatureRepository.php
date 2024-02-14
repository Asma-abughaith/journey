<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\FeatureEntity;
use App\Interfaces\Gateways\Web\Admin\FeatureRepositoryInterface;
use App\Models\Feature;



class EloquentFeatureRepository implements FeatureRepositoryInterface
{
    public function getAllFeatures()
    {
        $eloquentFeatures = Feature::all();
        $features = [];

        foreach ($eloquentFeatures as $eloquentFeature) {
            $features[] = $this->convertToEntity($eloquentFeature);
        }

        return $features;
    }

    public function getFeature($feature)
    {
        return $this->convertToEntity($feature);
    }

    public function getFeatureById($featureId)
    {
        $eloquentFeature = Feature::find($featureId);
        return $eloquentFeature ? $this->convertToEntity($eloquentFeature) : null;
    }

    public function createFeature(array $featureData)
    {
        $eloquentFeature = Feature::create($featureData);
        $eloquentFeature->setTranslations('name', $featureData['name']);
        return $this->convertToEntity($eloquentFeature);
    }

    public function updateFeature($feature, array $featureData)
    {
        $feature->update($featureData);
        $feature->setTranslations('name', $featureData['name']);
        return $this->convertToEntity($feature);
    }


    public function deleteFeature($feature)
    {
        if ($feature) {
            $feature->delete();
        }
        return;
    }

    protected function convertToEntity(Feature $eloquentFeature)
    {
        $names =$eloquentFeature->getTranslations('name');
        $feature = new FeatureEntity();
        $feature->setId($eloquentFeature->id);
        $feature->setName($eloquentFeature->name);
        $feature->setNameEn($names['en']);
        $feature->setNameAr($names['ar']);
        $feature->setIcon($eloquentFeature->icon);
        return $feature;
    }
}
