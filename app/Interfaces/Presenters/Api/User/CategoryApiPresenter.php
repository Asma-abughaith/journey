<?php

namespace App\Interfaces\Presenters\Api\User;

use App\Entities\Api\User\CategoryApiEntity;

class CategoryApiPresenter
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

    protected function formatCategory(CategoryApiEntity $category)
    {
        $lang =request()->lang;
        $nameLang = 'getName' . ucfirst($lang);

        return [
            'id' => $category->getId(),
            'name'=>$category->$nameLang(),
            'image' => $category->getImage(),
            'priority'=>$category->getPriority(),
        ];
    }
}
