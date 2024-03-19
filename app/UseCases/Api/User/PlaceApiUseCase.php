<?php

namespace App\UseCases\Api\User;

use App\Interfaces\Gateways\Api\User\PlaceApiRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PlaceApiUseCase
{
    protected $placeApiRepository;

    public function __construct(PlaceApiRepositoryInterface $placeApiRepository)
    {
        $this->placeApiRepository = $placeApiRepository;
    }

    public function singlePlace($id)
    {
        return $this->placeApiRepository->singlePlace($id);
    }

    public function createFavoritePlace($id)
    {
        $user_id = Auth::guard('api')->user()->id;
        $data=[
            'place_id'=>$id,
            'user_id'=>$user_id
        ];
        return $this->placeApiRepository->createFavoritePlace($data);
    }

    public function deleteFavoritePlace($id)
    {
        return $this->placeApiRepository->deleteFavoritePlace($id);
    }

    public function createVisitedPlace($id)
    {
        $user_id = Auth::guard('api')->user()->id;
        $data=[
            'place_id'=>$id,
            'user_id'=>$user_id
        ];
        return $this->placeApiRepository->createVisitedPlace($data);
    }

    public function deleteVisitedPlace($id)
    {
        return $this->placeApiRepository->deleteVisitedPlace($id);
    }


}
