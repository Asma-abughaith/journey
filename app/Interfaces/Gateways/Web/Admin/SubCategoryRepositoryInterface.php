<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface SubCategoryRepositoryInterface
{
    public function getAllSubCategories();

    public function getSubCategoryById($subCategoryId);

    public function getSubCategory($subCategory);

    public function createSubCategory(array $subCategoryData, array $imageData);

    public function updateSubCategory($subCategory, array $subCategoryData, array $imageData);

    public function deleteSubCategory($subCategory);
}
