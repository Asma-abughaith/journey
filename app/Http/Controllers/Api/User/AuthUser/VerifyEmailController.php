<?php

namespace App\Http\Controllers\Api\User\AuthUser;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                "message" => __('app.you-have-already-verified')
            ]);
            //you have already verified your email
            //           return view('verify.index');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        return response()->json([
            "message" => __('you-have-verified-email-successfully')
        ]);
    }
}
