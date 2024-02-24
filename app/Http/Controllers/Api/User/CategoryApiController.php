<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\UseCases\Api\User\CategoryApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


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

    public function shuffleAllCategories()
    {
        try{
            $categories = $this->categoryApiUseCase->shuffleAllCategories();
            return ApiResponse::sendResponse(200, 'Categories Retrieved Successfully', $categories);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }

    public function categoryPlaces(Request $request)
    {
        $id = $request->category_id;
        $validator = Validator::make(['category_id' => $id], [
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $validator->errors());
        }
        try{
            $allPlaces = $this->categoryApiUseCase->allPlacesByCategory($id);

            return ApiResponse::sendResponse(200, 'Places and SubCategories by Category id Retrieved Successfully', $allPlaces);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }


}
