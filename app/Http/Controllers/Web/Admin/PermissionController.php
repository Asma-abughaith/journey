<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Permission\StorePermissionRequest;
use App\Http\Requests\Web\Admin\Permission\UpdatePermissionRequest;
use App\Interfaces\Presenters\Web\Admin\PermissionPresenter;
use App\UseCases\Web\Admin\PermissionUseCase;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{

    protected $permissionPresenter;
    protected $permissionUseCase;

    public function __construct( PermissionPresenter $permissionPresenter, PermissionUseCase $permissionUseCase) {
        $this->permissionPresenter = $permissionPresenter;
        $this->permissionUseCase = $permissionUseCase;

//        $this->middleware('check_permission:view permissions')->only(['index']);
//        $this->middleware('check_permission:create permission')->only(['create', 'store']);
//        $this->middleware('check_permission:view permissions')->only(['show']);
//        $this->middleware('check_permission:edit permission')->only(['edit', 'update']);
//        $this->middleware('check_permission:delete permission')->only(['destroy']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
        $allPermissions = $this->permissionUseCase->allPermissions();
        $permissions = $this->permissionPresenter->presentAllPermissions($allPermissions);
        return view('admin.permissions.index',compact('permissions'));
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
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        try {
            $this->permissionUseCase->createPermission( $request->validated());
            Toastr::success('Permission created successfully!', 'Success');
            return redirect()->route('admin.permissions.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        try {
            $this->permissionUseCase->updatePermission($permission, $request->validated());
            Toastr::success('Permission updated successfully!', 'Success');
            return redirect()->route('admin.permissions.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permissionId)
    {
        try {
            $this->permissionUseCase->deletePermission($permissionId);
            Toastr::success('The Permission Deleted successfully!', 'Delete');
            return redirect()->route('admin.permissions.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }

    }
}
