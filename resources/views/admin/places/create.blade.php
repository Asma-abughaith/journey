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
                            <form method="post" action="{{ route('admin.places.store') }}" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip01">{{ __('app.name-en') }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ __('app.place-en') }}" name="name_en"
                                                value="{{ old('name_en') }}" id="validationTooltip01" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip02">{{ __('app.name-ar') }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ __('app.place-ar') }}" name="name_ar"
                                                value="{{ old('name_ar') }}" id="validationTooltip02" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip03">{{ __('app.description-en') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.description-enter-en') }}" name="description_en"
                                                value="{{ old('description_en') }}" id="validationTooltip03">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip04">{{ __('app.description-ar') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.description-enter-ar') }}" name="description_ar"
                                                value="{{ old('description_ar') }}" id="validationTooltip04">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip05">{{ __('app.address-en') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.address-enter-en') }}" name="address_en"
                                                value="{{ old('address_en') }}" id="validationTooltip05">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip06">{{ __('app.address-ar') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.address-enter-ar') }}" name="address_ar"
                                                value="{{ old('address_ar') }}" id="validationTooltip06">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip07">{{ __('app.google-map-url') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.google-map-url-enter') }}" name="google_map_url"
                                                value="{{ old('google_map_url') }}" id="validationTooltip07">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip08">{{ __('app.phone-number') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.phone-number-enter') }}" name="phone_number"
                                                value="{{ old('phone_number') }}" id="validationTooltip08">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip09">{{ __('app.longitude') }}</label>
                                            <input required type="number" class="form-control"
                                                placeholder="{{ __('app.longitude-enter') }}" name="longitude"
                                                value="{{ old('longitude') }}" id="validationTooltip09" step="0.1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip10">{{ __('app.latitude') }}</label>
                                            <input required type="number" class="form-control"
                                                placeholder="{{ __('app.latitude-enter') }}" name="latitude"
                                                value="{{ old('latitude') }}" id="validationTooltip10" step="0.1">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip11">{{ __('app.price-level') }}</label>
                                            <input required type="number" class="form-control"
                                                placeholder="{{ __('app.price-level-enter') }}" name="price_level"
                                                value="{{ old('price_level') }}" id="validationTooltip11" max="4" min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip12">{{ __('app.website') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.website-enter') }}" name="website"
                                                value="{{ old('website') }}" id="validationTooltip12">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip13">{{ __('app.rating') }}</label>
                                            <input required type="number" class="form-control"
                                                placeholder="{{ __('app.rating-enter') }}" name="rating"
                                                value="{{ old('rating') }}" id="validationTooltip13" step="0.1" max="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip14">{{ __('app.total-user-rating') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.total-user-rating-enter') }}"
                                                name="total_user_rating" value="{{ old('total_user_rating') }}"
                                                id="validationTooltip14">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip15">{{ __('app.sub-categories') }}</label>
                                            <select class="form-select" name="sub_category_id" id="validationTooltip15">
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
                                            <label class="form-label"
                                                for="validationTooltip16">{{ __('app.regions') }}</label>
                                            <select class="form-select" name="region_id" id="validationTooltip16">
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
                                            <label class="form-label"
                                                for="validationTooltip17">{{ __('app.business-status') }}</label>
                                            <select class="form-select" name="business_status" id="validationTooltip17"
                                                required>
                                                <option value="">{{ __('app.select-one') }}</option>
                                                <option value="operational">{{ __('app.operational') }}</option>
                                                <option value="closed">{{ __('app.closed') }}</option>
                                                <option value="temporary_closed">{{ __('app.temporary_closed') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip18">{{ __('app.tags') }}</label>
                                            <select class="select2 form-control select2-multiple" name="tags_id[]"
                                                multiple data-placeholder="{{ __('app.choose...') }}" required
                                                id="validationTooltip18">
                                                <option value="">{{ __('app.select-one') }}</option>
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
                                            <label class="form-label"
                                                for="mainImageInput">{{ __('app.main-image') }}</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="main_image"
                                                    id="mainImageInput" required accept="image/*">
                                            </div>
                                            <small
                                                class="form-text text-muted">{{ __('app.choose-a-main-image-for-your-category.') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <img src=" {{ asset('category.jpg') }} " alt="{{ __('app.main-image') }}"
                                                id="mainPreviewImage" style="width: 80px; height: 80px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="galleryInput">{{ __('app.gallery-images') }}</label>
                                    <input type="file" class="form-control" name="gallery_images[]" id="galleryInput"
                                        multiple required>
                                </div>

                                <div id="galleryPreview">
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#validationTooltip17").select2({
                placeholder: "{{ __('app.select-one') }}",
                width: "100%",
            });
            $("#validationTooltip16").select2({
                placeholder: "{{ __('app.select-one') }}",
                width: "100%",
            });
            $("#validationTooltip15").select2({
                placeholder: "{{ __('app.select-one') }}",
                width: "100%",
            });

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
                            var img = $('<img>').attr('src', e.target.result).css('width', '80px').css(
                                'height', '80px');
                            $(previewContainer).append(img);
                        }

                        reader.readAsDataURL(file);
                    });
                }
            }
        });
    </script>
@endpush
