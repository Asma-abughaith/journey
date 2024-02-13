<?php

namespace App\Repositories\Api\User;

use App\Entities\Api\User\CategoryApiEntity;
use App\Interfaces\Gateways\Api\User\CategoryApiRepositoryInterface;
use App\Models\Category;


class EloquentCategoryApiRepository implements CategoryApiRepositoryInterface
{
    public function getAllCategories()
    {
        $eloquentCategories = Category::orderBy('priority')->get();
        $categories = [];


        foreach ($eloquentCategories as $eloquentCategory) {
            $categories[] = $this->convertToEntity($eloquentCategory);
        }

        return $categories;
    }

    protected function convertToEntity(Category $eloquentCategory)
    {
        $names =$eloquentCategory->getTranslations('name');
        $category = new CategoryApiEntity();
        $category->setId($eloquentCategory->id);
        $category->setName($eloquentCategory->name);
        $category->setNameEn($names['en']);
        $category->setNameAr($names['ar']);
        $category->setImage($eloquentCategory->getFirstMediaUrl('category', 'category_app'));
        $category->setPriority($eloquentCategory->priority);
        return $category;
    }


}
