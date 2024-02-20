<?php

namespace App\Interfaces\Gateways\Api\User;


interface PlaceApiRepositoryInterface
{
    public function allPlacesByCategory($id);

    public function singlePlace($id);

}
