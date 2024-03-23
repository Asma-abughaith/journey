<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\UseCases\Api\User\PlanApiUseCase;
use Illuminate\Http\Request;

class PlanApiController extends Controller
{
    protected $planApiUseCase;

    public function __construct(PlanApiUseCase $planApiUseCase) {

        $this->planApiUseCase = $planApiUseCase;

    }
}
