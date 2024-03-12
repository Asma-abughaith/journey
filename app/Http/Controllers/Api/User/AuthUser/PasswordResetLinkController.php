<?php

namespace App\Http\Controllers\Api\User\AuthUser;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\PasswordRestLinkRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PasswordRestLinkRequest $request)
    {
        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status == Password::RESET_LINK_SENT) {
                return ApiResponse::sendResponse(200, 'the link for reset password sent successfully', null);

            } else {
                return ApiResponse::sendResponse(400, 'Unable to send the link for reset password', null);

            }
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }

    }
}
