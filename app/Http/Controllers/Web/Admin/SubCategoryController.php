<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\Web\Admin\SubCategory\UpdateSubCategoryRequest;
use App\Interfaces\Presenters\Web\Admin\CategoryPresenter;
use App\Interfaces\Presenters\Web\Admin\SubCategoryPresenter;
use App\Models\SubCategory;
use App\UseCases\Web\Admin\CategoryUseCase;
use App\UseCases\Web\Admin\SubCategoryUseCase;
use Brian2694\Toastr\Facades\Toastr;

class SubCategoryController extends Controller
{
    protected $subCategoryPresenter;
    protected $subCategoryUseCase;
    protected $categoryPresenter;
    protected $categoryUseCase;

    public function __construct(SubCategoryPresenter $subCategoryPresenter, SubCategoryUseCase $subCategoryUseCase, CategoryPresenter $categoryPresenter, CategoryUseCase $categoryUseCase)
    {
        $this->subCategoryPresenter = $subCategoryPresenter;
        $this->subCategoryUseCase = $subCategoryUseCase;
        $this->categoryPresenter = $categoryPresenter;
        $this->categoryUseCase = $categoryUseCase;

//        $this->middleware('checkPermission:view subcategories')->only(['index']);
//        $this->middleware('checkPermission:create category')->only(['create', 'store']);
//        $this->middleware('checkPermission:view subcategories')->only(['show']);
//        $this->middleware('checkPermission:edit category')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete category')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allSubCategories = $this->subCategoryUseCase->allSubCategories();
            $sub_categories = $this->subCategoryPresenter->presentAllSubCategories($allSubCategories);
            return view('admin.sub_categories.index', compact('sub_categories'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $allCategories = $this->categoryUseCase->allCategories();
            $categories = $this->categoryPresenter->presentAllCategoriesForSubCategories($allCategories);
            return view('admin.sub_categories.create', compact('categories'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        try {
            $this->subCategoryUseCase->createSubCategory($request->validated());
            Toastr::success('Sub Category created successfully!', 'Success');
            return redirect()->route('admin.sub_categories.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withErrors($request->errors)->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        try {
            $allCategories = $this->categoryUseCase->allCategories();
            $categories = $this->categoryPresenter->presentAllCategoriesForSubCategories($allCategories);
            $subCategory = $this->subCategoryUseCase->getSubCategory($subCategory);
            $subCategory = $this->subCategoryPresenter->persentSubCategory($subCategory);
            return view('admin.sub_categories.edit',compact('subCategory','categories'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        try {
            $this->subCategoryUseCase->updateSubCategory($subCategory, $request->validated());
            Toastr::success('SubCategories updated successfully!', 'Success');
            return redirect()->route('admin.sub_categories.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        try {
            $this->subCategoryUseCase->deleteSubCategory($subCategory);
            Toastr::success('The Sub Category Deleted successfully!', 'Delete');
            return redirect()->route('admin.sub_categories.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
