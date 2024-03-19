<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\CategoryEntity;
use App\Entities\Web\Admin\SubCategoryEntity;
use App\Interfaces\Gateways\Web\Admin\CategoryRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\SubCategoryRepositoryInterface;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;


class EloquentSubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function getAllSubCategories()
    {
        $eloquentSubCategories = SubCategory::with('category')->get();
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
        $eloquentSubCategory = SubCategory::create($subCategoryData);
        $eloquentSubCategory->setTranslations('name', $subCategoryData['name']);

        if ($imageData !== null) {
            $extension = pathinfo($imageData['image']?->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $eloquentSubCategory->addMediaFromRequest('image')->usingFileName($filename)->toMediaCollection('subcategory');
        }

        return $this->convertToEntity($eloquentSubCategory);
    }

    public function updateSubCategory($subCategory, array $subCategoryData, array $imageData)
    {

        $subCategory->update($subCategoryData);
        $subCategory->setTranslations('name', $subCategoryData['name']);
        if (isset($imageData['image']) && $imageData['image'] != null) {
            $extension = pathinfo($imageData['image']->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $subCategory->addMediaFromRequest('image')->usingFileName($filename)->toMediaCollection('subcategory');
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
        $subCategory->setCategory($eloquentSubCategory->category->name);
        return $subCategory;
    }
}
