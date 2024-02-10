<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\CategoryEntity;
use App\Interfaces\Gateways\Web\Admin\CategoryRepositoryInterface;
use App\Models\Category;


class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        $eloquentCategories = Category::all();
        $categories = [];

        foreach ($eloquentCategories as $eloquentCategory) {
            $categories[] = $this->convertToEntity($eloquentCategory);
        }

        return $categories;
    }

    public function getCategory($category)
    {
        return $this->convertToEntity($category);
    }

    public function getCategoryById($categoryId)
    {
        $eloquentCategory = Category::find($categoryId);

        return $eloquentCategory ? $this->convertToEntity($eloquentCategory) : null;
    }

    public function createCategory(array $categoryData, ?array $imageData)
    {
        $eloquentCategory = Category::create($categoryData);
        $eloquentCategory->setTranslations('name', $categoryData['name']);

        if ($imageData !== null) {
            $eloquentCategory->addMediaFromRequest('image')->toMediaCollection('category');
        }

        return $this->convertToEntity($eloquentCategory);
    }

    public function updateCategory($category, array $categoryData, array $imageData)
    {

        $category->update($categoryData);
        $category->setTranslations('name', $categoryData['name']);
        if (isset($imageData['image']) && $imageData['image'] != null) {
            $category->addMediaFromRequest('image')->toMediaCollection('category');
        }
        return $this->convertToEntity($category);
    }


    public function deleteCategory($category)
    {
        if ($category) {
            $category->delete();
        }
        return;
    }

    protected function convertToEntity(Category $eloquentCategory)
    {
        $names =$eloquentCategory->getTranslations('name');
        $category = new CategoryEntity();
        $category->setId($eloquentCategory->id);
        $category->setName($eloquentCategory->name);
        $category->setNameEn($names['en']);
        $category->setNameAr($names['ar']);
        $category->setImage($eloquentCategory->getFirstMediaUrl('category', 'category_app'));
        $category->setPriority($eloquentCategory->priority);
        return $category;
    }
}
