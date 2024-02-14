<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Tag\StoreTagRequest;
use App\Http\Requests\Web\Admin\Tag\UpdateTagRequest;
use App\Interfaces\Presenters\Web\Admin\TagPresenter;
use App\Models\Tag;
use App\UseCases\Web\Admin\TagUseCase;
use Brian2694\Toastr\Facades\Toastr;

class TagController extends Controller
{
    protected $tagPresenter;
    protected $tagUseCase;
    public function __construct( TagPresenter $tagPresenter, TagUseCase $tagUseCase) {
        $this->tagPresenter = $tagPresenter;
        $this->tagUseCase = $tagUseCase;

//        $this->middleware('checkPermission:view tags')->only(['index']);
//        $this->middleware('checkPermission:create tag')->only(['create', 'store']);
//        $this->middleware('checkPermission:view tags')->only(['show']);
//        $this->middleware('checkPermission:edit tag')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete tag')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allTags = $this->tagUseCase->allTags();
            $tags = $this->tagPresenter->presentAllTags($allTags);
            return view('admin.tags.index',compact('tags'));
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
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        try {
            $this->tagUseCase->createTag( $request->validated());
            Toastr::success('Tag created successfully!', 'Success');
            return redirect()->route('admin.tags.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        try {
            $tag = $this->tagUseCase->getTag($tag);
            $tag = $this->tagPresenter->presentTag($tag);
            return view('admin.tags.edit',compact('tag'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        try {
            $this->tagUseCase->updateTag($tag, $request->validated());
            Toastr::success('Tag updated successfully!', 'Success');
            return redirect()->route('admin.tags.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            $this->tagUseCase->deleteTag($tag);
            Toastr::success('The Tag Deleted successfully!', 'Delete');
            return redirect()->route('admin.tags.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
