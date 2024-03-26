<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Post\CreatePostApiRequest;
use App\UseCases\Api\User\PostApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
