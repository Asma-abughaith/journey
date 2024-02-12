<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Interfaces\Presenters\Web\Admin\SubCategoryPresenter;
use App\UseCases\Web\Admin\SubCategoryUseCase;
use App\Interfaces\Presenters\Web\Admin\CategoryPresenter;
use App\UseCases\Web\Admin\CategoryUseCase;
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
            $allSubCategories = $this->categoryUseCase->allCategories();
            $sub_categories = $this->categoryPresenter->presentAllCategoriesForSubCategories($allSubCategories);
            return view('admin.sub_categories.create', compact('sub_categories'));
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
