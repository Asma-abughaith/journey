@extends('admin.master')
@section('title', __('app.dashboard-place'))
@section('place-active', 'active')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                @include('layouts.admin.title', ['title' => __('app.create-place')])
                <!-- end page title -->

                <div class="col-xl-12 mx-auto" style="margin-top: 2.5%;">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"></h4>



                            <form method="post" action="{{ route('admin.places.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="name_en">{{ __('app.name-en') }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ __('app.place-en') }}" name="name_en"
                                                value="{{ old('name_en') }}" id="name_en" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="name_ar">{{ __('app.name-ar') }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ __('app.place-ar') }}" name="name_ar"
                                                value="{{ old('name_ar') }}" id="name_ar" >
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="description_en">{{ __('app.description-en') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.description-en') }}" name="description_en"
                                                   value="{{ old('description_en') }}" id="description_en" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="description_ar">{{ __('app.description-ar') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.description-ar') }}" name="description_ar"
                                                   value="{{ old('description_ar') }}" id="description_ar" >
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="address_en">{{ __('app.address-en') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.address-en') }}" name="address_en"
                                                   value="{{ old('address_en') }}" id="address_en" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="address_ar">{{ __('app.address-ar') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.address-ar') }}" name="address_ar"
                                                   value="{{ old('address_ar') }}" id="address_ar" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="google_map_url">{{ __('app.google_map_url') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.google_map_url') }}" name="google_map_url"
                                                   value="{{ old('google_map_url') }}" id="google_map_url" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone_number">{{ __('app.phone_number') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.phone_number') }}" name="phone_number"
                                                   value="{{ old('phone_number') }}" id="phone_number" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="longitude">{{ __('app.longitude') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.longitude') }}" name="longitude"
                                                   value="{{ old('longitude') }}" id="longitude" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="latitude">{{ __('app.latitude') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.latitude') }}" name="latitude"
                                                   value="{{ old('latitude') }}" id="latitude" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="price_level">{{ __('app.price_level') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.price_level') }}" name="price_level"
                                                   value="{{ old('price_level') }}" id="price_level" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="website">{{ __('app.website') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.website') }}" name="website"
                                                   value="{{ old('website') }}" id="website" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="rating">{{ __('app.rating') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.rating') }}" name="rating"
                                                   value="{{ old('rating') }}" id="rating" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="total_user_rating">{{ __('app.total_user_rating') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.total_user_rating') }}" name="total_user_rating"
                                                   value="{{ old('total_user_rating') }}" id="total_user_rating" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="sub_category_id">{{ __('app.subcategories') }}</label>
                                            <select class="form-select" name="sub_category_id" id="sub_category_id" >
                                                <option value="" selected>{{ __('app.select-one') }}</option>
                                                @foreach ($subCategories as $subCategory)
                                                    <option value="{{ $subCategory['id'] }}">{{ $subCategory['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="region_id">{{ __('app.region') }}</label>
                                            <select class="form-select" name="region_id" id="region_id" >
                                                <option value="" selected>{{ __('app.select-one') }}</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region['id'] }}">{{ $region['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('app.business_status') }}</label>
                                            <select class="form-select" name="business_status">
                                                <option value="">{{ __('app.select-one') }}</option>
                                                <option value="operational">{{ __('app.operational') }}</option>
                                                <option value="closed">{{ __('app.closed') }}</option>
                                                <option value="temporary_closed">{{ __('app.temporary_closed') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="region_id">{{ __('app.tags') }}</label>
                                            <select class="form-select" name="tags_id[]" id="region_id" multiple="multiple" >
                                                <option value="" selected>{{ __('app.select-one') }}</option>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag['id'] }}">{{ $tag['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="mainImageInput">{{ __('Main Image') }}</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="main_image" id="mainImageInput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <img src=" {{asset('category.jpg')}} " alt="Main Image" id="mainPreviewImage" style="width: 80px; height: 80px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('Gallery Images') }}</label>
                                    <input type="file" class="form-control" name="gallery_images[]" id="galleryImagesInput" multiple>
                                </div>

                                <div id="galleryPreview">
                                    <!-- Display gallery preview here -->
                                </div>

                                <div style="text-align: end">
                                    <button class="btn btn-primary" type="submit">{{ __('app.create') }}</button>
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

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mainImageInput').change(function() {
                displayImagePreview(this, '#mainPreviewImage');
            });

            $('#galleryImagesInput').change(function() {
                displayGalleryPreview(this, '#galleryPreview');
            });

            function displayImagePreview(input, previewElement) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(previewElement).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function displayGalleryPreview(input, previewContainer) {
                $(previewContainer).html('');
                if (input.files) {
                    [...input.files].forEach(function(file) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            var img = $('<img>').attr('src', e.target.result).css('width', '80px').css('height', '80px');
                            $(previewContainer).append(img);
                        }

                        reader.readAsDataURL(file);
                    });
                }
            }
        });

    </script>







@endpush
