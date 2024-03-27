<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Post\CreatePostApiRequest;
use App\Http\Requests\Api\User\Post\UpdatePostApiRequest;
use App\Rules\CheckPostBelongToUser;
use App\UseCases\Api\User\PostApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostApiController extends Controller
{
    protected $postApiUseCase;

    public function __construct(PostApiUseCase $postApiUseCase)
    {

        $this->postApiUseCase = $postApiUseCase;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostApiRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $createTrip = $this->postApiUseCase->createPost($validatedData);
            return ApiResponse::sendResponse(200, __('app.post-created-successfully'), $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostApiRequest $request, string $id)
    {
        $validatedData = $request->validated();
        try {
            $createTrip = $this->postApiUseCase->updatePost($validatedData);
            return ApiResponse::sendResponse(200, __('app.post-created-successfully'), $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function show(Request $request)
    {
        $id = $request->post_id;
        $validator = Validator::make(['post_id' => $id], [
            'post_id' => ['required', 'exists:posts,id'],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['post_id'][0]);
        }

        try {
            $createTrip = $this->postApiUseCase->showPost($id);
            return ApiResponse::sendResponse(200, __('app.post-collected-successfully'), $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }

    }

    public function DeleteImage(Request $request)
    {
        $id = $request->media_id;
        $validator = Validator::make(['media_id' => $id], [
            'media_id' => ['required', 'exists:media,id'],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['media_id'][0]);
        }

        try {
            $createTrip = $this->postApiUseCase->deleteImage($id);
            return ApiResponse::sendResponse(200, __('app.post-image-deleted-successfully'), $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->post_id;
        $validator = Validator::make(['post_id' => $id], [
            'post_id' => ['required', 'exists:posts,id',new CheckPostBelongToUser()],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['post_id'][0]);
        }

        try {
            $createTrip = $this->postApiUseCase->delete($id);
            return ApiResponse::sendResponse(200, __('app.post-deleted-successfully'), $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }

    }
}
