<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\FeatureEntity;

class FeaturePresenter
{
    public function presentAllFeatures($features)
    {
        $formattedFeatures = [];

        foreach ($features as $feature) {
            $formattedFeatures[] = $this->formatFeature($feature);
        }
        return $formattedFeatures;
    }


    public function persentFeature($feature)
    {
        return $this->formatFeature($feature);
    }

    protected function formatFeature(FeatureEntity $feature)
    {
        return [
            'id' => $feature->getId(),
            'name' => $feature->getName(),
            'name_en' => $feature->getNameEn(),
            'name_ar' => $feature->getNameAr(),
            'icon'=>$feature->getIcon(),
        ];
    }

}
