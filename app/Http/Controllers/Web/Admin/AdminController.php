<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Admin\StoreAdminRequest;
use App\Http\Requests\Web\Admin\Admin\UpdateAdminRequest;
use App\Interfaces\Presenters\Web\Admin\AdminPresenter;
use App\Interfaces\Presenters\Web\Admin\RolePresenter;
use App\Models\Admin;
use App\UseCases\Web\Admin\AdminUseCase;
use App\UseCases\Web\Admin\RoleUseCase;
use Brian2694\Toastr\Facades\Toastr;


class AdminController extends Controller
{

    protected $adminPresenter;
    protected $adminUseCase;

    protected $rolePresenter;

    protected $roleUseCase;

    public function __construct(AdminPresenter $adminPresenter, AdminUseCase $adminUseCase, RoleUseCase $roleUseCase, RolePresenter $rolePresenter)
    {
        $this->adminPresenter = $adminPresenter;
        $this->adminUseCase = $adminUseCase;
        $this->roleUseCase = $roleUseCase;
        $this->rolePresenter = $rolePresenter;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allAdmins = $this->adminUseCase->allAdmins();
            $admins = $this->adminPresenter->presentAllAdmins($allAdmins);
            return view('admin.admins.index', compact('admins'));
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
            $allRoles = $this->roleUseCase->allRoles();
            $roles = $this->rolePresenter->presentAllRole($allRoles);
            return view('admin.admins.create', compact('roles'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        try {
            $this->adminUseCase->createAdmin($request->validated());
            Toastr::success('Admin created successfully!', 'Success');
            return redirect()->route('admin.admins.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        try {
            $allRoles = $this->roleUseCase->allRoles();
            $roles = $this->rolePresenter->presentAllRole($allRoles);
            $admin = $this->adminUseCase->getAdmin($admin);
            $admin = $this->adminPresenter->persentAdmin($admin);
            return view('admin.admins.edit', compact('roles', 'admin'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        try {
            $this->adminUseCase->updateAdmin($admin, $request->validated());
            Toastr::success('Admin updated successfully!', 'Success');
            return redirect()->route('admin.admins.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        try {
            $this->adminUseCase->deleteAdmin($admin);
            Toastr::success('The Admin Deleted successfully!', 'Delete');
            return redirect()->route('admin.admins.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }

    }
}