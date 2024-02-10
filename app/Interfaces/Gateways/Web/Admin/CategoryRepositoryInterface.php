<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface CategoryRepositoryInterface
{
    public function getAllCategories();

    public function getCategoryById($categoryId);

    public function getCategory($category);

    public function createCategory(array $categoryData, array $imageData);

    public function updateCategory($category, array $categoryData, array $imageData);

    public function deleteCategory($category);
}
