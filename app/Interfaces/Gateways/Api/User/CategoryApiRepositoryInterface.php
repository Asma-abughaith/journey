<?php

namespace App\Interfaces\Gateways\Api\User;


interface CategoryApiRepositoryInterface
{
    public function getAllCategories();

    public function shuffleAllCategories();
    public function allPlacesByCategory($id);


}
