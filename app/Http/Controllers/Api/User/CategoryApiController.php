<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Interfaces\Presenters\Api\User\CategoryApiPresenter;
use App\UseCases\Api\User\CategoryApiUseCase;
use Illuminate\Http\Response;


class CategoryApiController extends Controller
{
    protected $categoryApiUseCase;
    protected $categoryApiPresenter;

    public function __construct(CategoryApiUseCase $categoryUseCase, CategoryApiPresenter $categoryPresenter) {

        $this->categoryApiUseCase = $categoryUseCase;
        $this->categoryApiPresenter= $categoryPresenter;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allCategories = $this->categoryApiUseCase->allCategories();
            $categories = $this->categoryApiPresenter->presentAllCategories($allCategories);
            $categories =$categories? $categories:null;
            return ApiResponse::sendResponse(200, 'Categories Retrieved Successfully', $categories);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }


}
