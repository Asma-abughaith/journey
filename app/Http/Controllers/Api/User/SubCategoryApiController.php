<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\UseCases\Api\User\SubCategoryApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class SubCategoryApiController extends Controller
{

    protected $subCateogryApiUseCase;

    public function __construct(SubCategoryApiUseCase $subCateogryApiUseCase) {

        $this->subCateogryApiUseCase = $subCateogryApiUseCase;

    }
    public function singleSubCategory(Request $request)
    {
        $id = $request->subcategory_id;
        $validator = Validator::make(['subcategory_id' => $id], [
            'subcategory_id' => 'required|exists:sub_categories,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $validator->errors());
        }
        try{
            $subCategory = $this->subCateogryApiUseCase->singleSubCategory($id);

            return ApiResponse::sendResponse(200, 'Places of Subcategories Retrieved by id Successfully', $subCategory);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }
}
