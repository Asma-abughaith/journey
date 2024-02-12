<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\CategoryEntity;
use App\Entities\Web\Admin\SubCategoryEntity;
use App\Interfaces\Gateways\Web\Admin\CategoryRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\SubCategoryRepositoryInterface;
use App\Models\Category;
use App\Models\SubCategory;


class EloquentSubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function getAllSubCategories()
    {
        $eloquentSubCategories = SubCategory::all();
        $subCategories = [];

        foreach ($eloquentSubCategories as $eloquentSubCategory) {
            $subCategories[] = $this->convertToEntity($eloquentSubCategory);
        }

        return $subCategories;
    }

    public function getSubCategory($subCategory)
    {
        return $this->convertToEntity($subCategory);
    }

    public function getSubCategoryById($subCategoryId)
    {
        $eloquentSubCategory = SubCategory::find($subCategoryId);

        return $eloquentSubCategory ? $this->convertToEntity($eloquentSubCategory) : null;
    }

    public function createSubCategory(array $subCategoryData, ?array $imageData)
    {
        $eloquentSubCategory = Category::create($subCategoryData);
        $eloquentSubCategory->setTranslations('name', $subCategoryData['name']);

        if ($imageData !== null) {
            $eloquentSubCategory->addMediaFromRequest('image')->toMediaCollection('category');
        }

        return $this->convertToEntity($eloquentSubCategory);
    }

    public function updateSubCategory($subCategory, array $subCategoryData, array $imageData)
    {

        $subCategory->update($subCategoryData);
        $subCategory->setTranslations('name', $subCategoryData['name']);
        if (isset($imageData['image']) && $imageData['image'] != null) {
            $subCategory->addMediaFromRequest('image')->toMediaCollection('category');
        }
        return $this->convertToEntity($subCategory);
    }


    public function deleteSubCategory($subCategory)
    {
        if ($subCategory) {
            $subCategory->delete();
        }
        return;
    }

    protected function convertToEntity(SubCategory $eloquentSubCategory)
    {
        $names =$eloquentSubCategory->getTranslations('name');
        $subCategory = new SubCategoryEntity();
        $subCategory->setId($eloquentSubCategory->id);
        $subCategory->setName($eloquentSubCategory->name);
        $subCategory->setNameEn($names['en']);
        $subCategory->setNameAr($names['ar']);
        $subCategory->setImage($eloquentSubCategory->getFirstMediaUrl('subcategory', 'subcategory_app'));
        $subCategory->setPriority($eloquentSubCategory->priority);
        $subCategory->setCategory($eloquentSubCategory->category());
        return $subCategory;
    }
}
