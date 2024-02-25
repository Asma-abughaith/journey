<?php

namespace App\UseCases\Web\Admin;

use App\Entities\Web\Admin\PermissionEntity;
use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\CategoryRepositoryInterface;

class CategoryUseCase
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function allCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function getCategory($category)
    {
        return $this->categoryRepository->getCategory($category);
    }

    public function getCategoryById($categoryId)
    {
        return $this->categoryRepository->getCategoryById($categoryId);
    }

    public function createCategory($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->categoryRepository->createCategory(
            [
                'name' => $translator,
                'priority' =>  $request['priority'],
            ],
            ['image' => isset($request['image']) ? $request['image'] : null]
        );
    }

    public function updateCategory($category, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->categoryRepository->updateCategory(
            $category,
            [
                'name' => $translator,
                'priority' =>  $request['priority'],
            ],
            ['image' => isset($request['image']) ? $request['image'] : null]
        );
    }

    public function deleteCategory($category)
    {
        return $this->categoryRepository->deleteCategory($category);
    }

}
