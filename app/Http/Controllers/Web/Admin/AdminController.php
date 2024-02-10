<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Admin\StoreAdminRequest;
use App\Http\Requests\Web\Admin\Admin\UpdateAdminRequest;
use App\Interfaces\Presenters\Web\Admin\AdminPresenter;
use App\Models\Admin;
use App\UseCases\Web\Admin\AdminUseCase;
use Brian2694\Toastr\Facades\Toastr;


class AdminController extends Controller
{

    protected $adminPresenter;
    protected $adminUseCase;

    public function __construct(AdminPresenter $adminPresenter, AdminUseCase $adminUseCase)
    {
        $this->adminPresenter = $adminPresenter;
        $this->adminUseCase = $adminUseCase;
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
        return view('admin.admins.create');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
