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
        $allRoles = $this->roleUseCase->allRoles();
        $roles = $this->rolePresenter->presentAllRole($allRoles);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allPermission = $this->permissionUseCase->allPermissions();
        $permissions = $this->permissionPresenter->presentAllPermissionsForRoles($allPermission);
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $this->roleUseCase->createRole($request->validated());
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
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role = $this->roleUseCase->getRoleBind($role);
        dd($role);

        $roles = $this->rolePresenter->presentAllRole($role);
        $allPermission = $this->permissionUseCase->allPermissions();
        $permissions = $this->permissionPresenter->presentAllPermissionsForRoles($allPermission);
        return view('admin.permissions.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}