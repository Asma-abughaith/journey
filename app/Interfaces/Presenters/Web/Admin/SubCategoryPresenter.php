<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\AdminEntity;
use App\Entities\Web\Admin\CategoryEntity;
use App\Entities\Web\Admin\PermissionEntity;
use App\Entities\Web\Admin\SubCategoryEntity;

class SubCategoryPresenter
{
    public function presentAllSubCategories($subCategories)
    {
        $formattedSubCategories = [];

        foreach ($subCategories as $subCategory) {
            $formattedSubCategories[] = $this->formatSubCategory($subCategory);
        }
        return $formattedSubCategories;
    }

    public function persentSubCategory($subCategories){
        return $this->formatSubCategory($subCategories);
    }

    protected function formatSubCategory(SubCategoryEntity $subCategory)
    {
        return [
            'id' => $subCategory->getId(),
            'name' => $subCategory->getName(),
            'name_en'=>$subCategory->getNameEn(),
            'name_ar'=>$subCategory->getNameAr(),
            'image' => $subCategory->getImage(),
            'priority'=>$subCategory->getPriority(),
            'category'=>$subCategory->getCategory(),
        ];
    }
}
