<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\UseCases\Api\User\UserProfileApiUseCase;
use Illuminate\Http\Response;

class UserProfileController extends Controller
{
    protected $userProfileApiUseCase;

    public function __construct(UserProfileApiUseCase $userProfileApiUseCase)
    {

        $this->userProfileApiUseCase = $userProfileApiUseCase;
    }

    public function userDetails()
    {
        try {
            $userDetails = $this->userProfileApiUseCase->allUserDetails();
            return ApiResponse::sendResponse(200, 'User Details Retrieved Successfully', $userDetails);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }
}
