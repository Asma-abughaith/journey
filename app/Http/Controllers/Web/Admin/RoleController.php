<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\role\StoreRoleRequest;
use App\Http\Requests\Web\Admin\role\UpdateRoleRequest;
use App\Interfaces\Presenters\Web\Admin\PermissionPresenter;
use App\Interfaces\Presenters\Web\Admin\RolePresenter;
use App\UseCases\Web\Admin\PermissionUseCase;
use App\UseCases\Web\Admin\RoleUseCase;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $rolePresenter;
    protected $roleUseCase;

    protected $permissionUseCase;

    protected $permissionPresenter;

    public function __construct(RolePresenter $rolePresenter, RoleUseCase $roleUseCase, PermissionUseCase $permissionUseCase, PermissionPresenter $permissionPresenter)
    {
        $this->rolePresenter = $rolePresenter;
        $this->roleUseCase = $roleUseCase;
        $this->permissionUseCase = $permissionUseCase;
        $this->permissionPresenter = $permissionPresenter;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allRoles = $this->roleUseCase->allRoles();
            $roles = $this->rolePresenter->presentAllRole($allRoles);
            return view('admin.roles.index', compact('roles'));
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
        try{
        $allPermission = $this->permissionUseCase->allPermissions();
        $permissions = $this->permissionPresenter->presentAllPermissionsForRoles($allPermission);
        return view('admin.roles.create', compact('permissions'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $this->roleUseCase->createRole($request->validated());
            Toastr::success('Permission created successfully!', 'Success');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        try {
        $allPermission = $this->permissionUseCase->allPermissions();
        $permissions = $this->permissionPresenter->presentAllPermissionsForRoles($allPermission);
        return view('admin.roles.edit', compact('role', 'permissions'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            $this->roleUseCase->updateRole($role, $request->validated());
            Toastr::success('Role updated successfully!', 'Success');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $this->roleUseCase->deleteRole($role);
            Toastr::success('The Role Deleted successfully!', 'Delete');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
