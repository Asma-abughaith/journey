@extends('admin.master')
@section('title', 'Admin | Category')
@section('category-active', 'active')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                @include('layouts.admin.title', ['title' => __('app.edit-region')])
                <!-- end page title -->

                <div class="col-xl-12 mx-auto" style="margin-top: 2.5%;">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"></h4>



                            <form method="post" action="{{ route('admin.features.update', $feature['id']) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $feature['id'] }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="name_en">{{ __('app.name-en') }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ __('app.feature-en') }}" id="name_en" name="name_en"
                                                value="{{ old('name_en', $feature['name_en']) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="name_ar">{{ __('app.name-ar') }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ __('app.feature-ar') }}" id="name_ar" name="name_ar"
                                                value="{{ old('name_ar', $feature['name_ar']) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="icon">{{ __('app.icon') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.feature-icon') }}" name="icon"
                                                   value="{{ old('icon',$feature['icon']) }}" id="icon" required>
                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: end">
                                    <button class="btn btn-primary" type="submit">{{ __('app.update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
        <!-- End Page-content -->
        @include('layouts.admin.footer')
    </div>
@endsection

