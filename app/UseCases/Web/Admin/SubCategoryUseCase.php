<?php

namespace App\UseCases\Web\Admin;

use App\Interfaces\Gateways\Web\Admin\SubCategoryRepositoryInterface;

class SubCategoryUseCase
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function allSubCategories()
    {
        return $this->subCategoryRepository->getAllSubCategories();
    }

    public function getSubCategory($subCategory)
    {
        return $this->subCategoryRepository->getSubCategory($subCategory);
    }

    public function getSubCategoryById($subCategoryId)
    {
        return $this->subCategoryRepository->getSubCategoryById($subCategoryId);
    }

    public function createSubCategory($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->subCategoryRepository->createSubCategory(
            [
                'name' => $translator,
                'priority' =>  $request['priority'],
                'category_id'=>$request['category_id'],
                'icon'=>$request['icon'],
            ],
            ['image' => isset($request['image']) ? $request['image'] : null],

        );
    }

    public function updateSubCategory($subCategory, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->subCategoryRepository->updateSubCategory(
            $subCategory,
            [
                'name' => $translator,
                'priority' =>  $request['priority'],
                'category_id'=>$request['category_id'],
                'icon'=>$request['icon'],
            ],
            ['image' => isset($request['image']) ? $request['image'] : null]
        );
    }

    public function deleteSubCategory($subCategory)
    {
        return $this->subCategoryRepository->deleteSubCategory($subCategory);
    }
}
