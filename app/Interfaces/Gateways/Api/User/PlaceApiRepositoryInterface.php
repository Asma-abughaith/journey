<?php

namespace App\Interfaces\Gateways\Api\User;


interface PlaceApiRepositoryInterface
{
    public function singlePlace($id);
    public function createFavoritePlace($data);
    public function deleteFavoritePlace($id);

    public function createVisitedPlace($data);
    public function deleteVisitedPlace($id);
}
