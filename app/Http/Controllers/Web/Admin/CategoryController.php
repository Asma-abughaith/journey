<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Web\Admin\Category\UpdateCategoryRequest;
use App\Interfaces\Presenters\Web\Admin\CategoryPresenter;
use App\Models\Category;
use App\UseCases\Web\Admin\CategoryUseCase;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    protected $categoryPresenter;
    protected $categoryUseCase;

    public function __construct( CategoryPresenter $categoryPresenter, CategoryUseCase $categoryUseCase) {
        $this->categoryPresenter = $categoryPresenter;
        $this->categoryUseCase = $categoryUseCase;

//        $this->middleware('checkPermission:view categories')->only(['index']);
//        $this->middleware('checkPermission:create category')->only(['create', 'store']);
//        $this->middleware('checkPermission:view categories')->only(['show']);
//        $this->middleware('checkPermission:edit category')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete category')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allCategories = $this->categoryUseCase->allCategories();
            $categories = $this->categoryPresenter->presentAllCategories($allCategories);
            return view('admin.categories.index',compact('categories'));
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
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $this->categoryUseCase->createCategory( $request->validated());
            Toastr::success(__('validation.msg.category-created-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        try {
            $category = $this->categoryUseCase->getCategory($category);
            $category = $this->categoryPresenter->persentCategory($category);
            return view('admin.categories.edit',compact('category'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $this->categoryUseCase->updateCategory($category, $request->validated());
            Toastr::success(__('validation.msg.categories-updated-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $this->categoryUseCase->deleteCategory($category);
            Toastr::success(__('validation.msg.categories-deleted-successfully!'), __('validation.msg.delete'));
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
