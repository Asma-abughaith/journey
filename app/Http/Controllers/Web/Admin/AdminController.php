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

        //        $this->middleware('checkPermission:view admins')->only(['index']);
        //        $this->middleware('checkPermission:create admin')->only(['create', 'store']);
        //        $this->middleware('checkPermission:view admins')->only(['show']);
        //        $this->middleware('checkPermission:edit admin')->only(['edit', 'update']);
        //        $this->middleware('checkPermission:delete admin')->only(['destroy']);
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
            Toastr::success(__('validation.msg.admin-created-successfully'), __('validation.msg.success'));
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
            Toastr::success(__('validation.msg.admin-updated-successfully'), __('validation.msg.success'));
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
            Toastr::success(__('validation.msg.admin-deleted-successfully'), __('validation.msg.delete'));
            return redirect()->route('admin.admins.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
