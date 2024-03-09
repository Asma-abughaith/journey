<?php

namespace App\Http\Controllers\Api\User\AuthUser;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;

use App\Http\Requests\Api\User\Auth\EmailVerificationRequest;
use App\Http\Requests\Api\User\Auth\LoginApiUserRequest;
use App\Http\Requests\Api\User\Auth\RegisterApiUserRequest;
use App\Models\User;

use App\Notifications\Users\UserEmailVerificationNotification;
use App\UseCases\Api\User\AuthApiUseCase;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
class AuthUserController extends Controller
{
    protected $authApiUseCase;

    public function __construct(AuthApiUseCase $authApiUseCase) {

        $this->authApiUseCase = $authApiUseCase;

    }

    public function register(RegisterApiUserRequest $request)
    {
        $lang = request()->lang;
        try {
            $user = $this->authApiUseCase->register($request->validated(),$lang);
            return ApiResponse::sendResponse(200, 'user registered Successfully', $user);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }

    }

    public function login(LoginApiUserRequest $request)
    {
        try {
            $user = $this->authApiUseCase->login($request->validated());
            return ApiResponse::sendResponse(200, 'user logged in Successfully', $user);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(401, $e->getMessage(),null);
        }

    }

    public function checkEmailVerification(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                "message" => __('app.you-have-already-verified')
            ]);
            //you have already verified your email
//           return view('verifiy.index');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

        }
        return response()->json([
            "message" => __('you-have-verified-email-successfully')
        ]);
    }

    public function resendEmailVerification(Request $request)
    {
        $user =Auth::guard('api')->user();
        if ($user->hasVerifiedEmail()) {
            return response(['message'=> __('json-api-auth.email_already_verified')]);
        }
        $user->notify(new UserEmailVerificationNotification());

        return response()->json([
            'message' => __('json-api-auth.email_sent'),
        ], 200);
    }

    public function sendRestPasswordLink(Request $request){
        $request->validate([
            'email' => ['required', 'email'],

        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );


//        return $status == Password::RESET_LINK_SENT
//            ? back()->with('status', __($status))
//            : back()->withInput($request->only('email'))
//                ->withErrors(['email' => __($status)]);
    }

    public function resetPassword(){

    }

    public function restPasswordRequest(Request $request){
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);



        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return 'password rest successfully';
    }
}
