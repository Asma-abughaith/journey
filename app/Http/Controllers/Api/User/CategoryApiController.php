<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\UseCases\Api\User\CategoryApiUseCase;
use Illuminate\Http\Response;


class CategoryApiController extends Controller
{
    protected $categoryApiUseCase;
    protected $categoryApiPresenter;

    public function __construct(CategoryApiUseCase $categoryUseCase) {

        $this->categoryApiUseCase = $categoryUseCase;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories = $this->categoryApiUseCase->allCategories();
            return ApiResponse::sendResponse(200, 'Categories Retrieved Successfully', $categories);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }


}
