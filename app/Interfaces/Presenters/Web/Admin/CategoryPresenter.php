<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\AdminEntity;
use App\Entities\Web\Admin\CategoryEntity;
use App\Entities\Web\Admin\PermissionEntity;

class CategoryPresenter
{
    public function presentAllCategories($categories)
    {
        $formattedCategories = [];

        foreach ($categories as $category) {
            $formattedCategories[] = $this->formatCategory($category);
        }
        return $formattedCategories;
    }

    public function persentCategory($category){
        return $this->formatCategory($category);
    }

    protected function formatCategory(CategoryEntity $category)
    {
        return [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'name_en'=>$category->getNameEn(),
            'name_ar'=>$category->getNameAr(),
            'image' => $category->getImage(),
            'priority'=>$category->getPriority(),
        ];
    }
}
