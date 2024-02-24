<?php

namespace App\UseCases\Api\User;


use App\Interfaces\Gateways\Api\User\CategoryApiRepositoryInterface;

class CategoryApiUseCase
{
    protected $categoryRepository;

    public function __construct(CategoryApiRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function allCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function shuffleAllCategories()
    {
        return $this->categoryRepository->shuffleAllCategories();
    }

    public function allPlacesByCategory($id)
    {
        return $this->categoryRepository->allPlacesByCategory($id);
    }


}
