<?php

namespace App\UseCases\Api\User;

use App\Interfaces\Gateways\Api\User\VolunteeringApiRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class VolunteeringApiUseCase
{
    protected $volunteeringRepository;

    public function __construct(VolunteeringApiRepositoryInterface $volunteeringRepository)
    {
        $this->volunteeringRepository = $volunteeringRepository;
    }

    public function allVolunteerings()
    {
        return $this->volunteeringRepository->getAllVolunteerings();
    }

    public function activeVolunteerings()
    {
        return $this->volunteeringRepository->activeVolunteerings();
    }

    public function Volunteering($id)
    {
        return $this->volunteeringRepository->volunteering($id);
    }

    public function dateVolunteerings($date)
    {
        return $this->volunteeringRepository->dateVolunteerings($date);
    }

    public function interestVolunteering($id)
    {
        $user_id = Auth::guard('api')->user()->id;
        $data=[
            'volunteering_id'=>$id,
            'user_id'=>$user_id
        ];
        return $this->volunteeringRepository->createInterestVolunteering($data);

    }

    public function disinterestVolunteering($id)
    {
        return $this->volunteeringRepository->disinterestVolunteering($id);
    }

    public function favorite($id)
    {
        return $this->volunteeringRepository->favorite($id);

    }

    public function deleteFavorite($id)
    {
        return $this->volunteeringRepository->deleteFavorite($id);

    }




}
