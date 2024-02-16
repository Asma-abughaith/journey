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
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.longitude-enter') }}" name="longitude"
                                                value="{{ old('longitude') }}" id="validationTooltip09">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip10">{{ __('app.latitude') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.latitude-enter') }}" name="latitude"
                                                value="{{ old('latitude') }}" id="validationTooltip10">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="validationTooltip11">{{ __('app.price-level') }}</label>
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.price-level-enter') }}" name="price_level"
                                                value="{{ old('price_level') }}" id="validationTooltip11">
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
                                            <input required type="text" class="form-control"
                                                placeholder="{{ __('app.rating-enter') }}" name="rating"
                                                value="{{ old('rating') }}" id="validationTooltip13">
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
                                    <input type="hidden" id="count" value="0">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="day_of_week0">{{ __('app.day-of-week') }}</label>
                                            <select class="select2 form-control select2-multiple" name="day_of_week[]"
                                                id="day_of_week0" multiple data-placeholder="{{ __('app.choose...') }}"
                                                required onchange="check(0)">
                                                <option value="Monday">{{ __('app.monday') }}</option>
                                                <option value="Tuesday">{{ __('app.tuesday') }}</option>
                                                <option value="Wednesday">{{ __('app.wednesday') }}</option>
                                                <option value="Thursday">{{ __('app.thursday') }}</option>
                                                <option value="Friday">{{ __('app.friday') }}</option>
                                                <option value="Saturday">{{ __('app.saturday') }}</option>
                                                <option value="Sunday">{{ __('app.sunday') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="opening_time">{{ __('app.opening-time') }}</label>
                                            <input type="time" class="form-control" name="opening_hours[]"
                                                value="{{ old('opening_time') }}" id="opening_time" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="closing_time">{{ __('app.closing-time') }}</label>
                                            <input type="time" class="form-control" name="closing_hours[]"
                                                value="{{ old('closing_time') }}" id="closing_time" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3 text-center">
                                            <label class="form-label"
                                                for="validationTooltip13">{{ __('app.add') }}</label>
                                            <br>
                                            <button class="icon-button" onclick="addWeekDay()"
                                                style="background: none; border: none; padding: 0; cursor: pointer;"
                                                type="button">
                                                <i class="ri-add-circle-fill"
                                                    style="font-size: 24px; color: #1eb137;"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>

                                <div id="add_week_day">
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
        function addWeekDay() {
            let counter = $('#count').val();
            let days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

            let old_days = [];
            for (let index = 0; index <= counter; index++) {
                let dayValue = $('#day_of_week' + index).val();
                if (dayValue) {
                    if (dayValue.length === 0) {
                        Swal.fire({
                            icon: 'error',
                            text: "{{ __('app.at-least-on-day') }}",
                        });
                        return;
                    }
                    if (dayValue && Array.isArray(dayValue)) {
                        old_days = old_days.concat(dayValue);
                    } else if (dayValue && typeof dayValue === 'string') {
                        old_days.push(dayValue);
                    }
                }
            }

            let new_days = days.filter(day => !old_days.includes(day));

            if (new_days.length == 0) {
                return;
            }

            counter++;

            $("#add_week_day").append(`
                 <div class="row" id="remove${counter}">
                     <div class="col-md-6">
                         <div class="mb-3">
                             <label class="form-label" for="day_of_week${counter}">{{ __('app.day-of-week') }}</label>
                             <select class="select2 form-control select2-multiple" name="day_of_week[]"
                                 id="day_of_week${counter}" multiple data-placeholder="{{ __('app.choose...') }}" onchange="check(${counter})" required>
                                 ${new_days.map(day => `<option value="${day}">${day}</option>`).join('')}
                             </select>
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="mb-3">
                             <label class="form-label" for="opening_time${counter}">{{ __('app.opening-time') }}</label>
                             <input type="time" class="form-control" name="opening_hours[]" value="{{ old('opening_time') }}" id="opening_time${counter}" required>
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="mb-3">
                             <label class="form-label" for="closing_time${counter}">{{ __('app.closing-time') }}</label>
                             <input type="time" class="form-control" name="closing_hours[]" value="{{ old('closing_time') }}" id="closing_time${counter}" required>
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="mb-3 text-center">
                             <label class="form-label" for="validationTooltip13">{{ __('app.remove') }}</label><br>
                             <button class="icon-button" onclick="remove((${counter}))"
                                 style="background: none; border: none; padding: 0; cursor: pointer;" type="button">
                                 <i class="ri-delete-bin-fill" style="font-size: 24px; color: rgb(177, 37, 30);"></i>
                             </button>
                         </div>
                     </div>
                 </div>
            `);
            $(`#day_of_week${counter}`).select2();
            $('#count').val(counter);
        }

        function check(id) {
            let counter = $('#count').val();
            let days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

            let new_days = [];
            for (let index = 0; index <= counter; index++) {
                let new_values = $('#day_of_week' + index).val();
                if (new_values) {
                    for (let innerIndex = 0; innerIndex < new_values.length; innerIndex++) {
                        new_days.push(new_values[innerIndex]);
                    }
                }
            }

            for (let index = 0; index <= counter; index++) {
                let old_values = $('#day_of_week' + index).val();
                if (old_values) {
                    let new_array = days.filter(day => !new_days.includes(day));

                    $('#day_of_week' + index).empty();

                    old_values.forEach(old_value => {
                        $('#day_of_week' + index).append($('<option></option>').attr('value', old_value).text(
                                old_value)
                            .prop('selected', true));
                    });

                    new_array.forEach(new_value => {
                        $('#day_of_week' + index).append($('<option></option>').attr('value', new_value).text(
                            new_value));
                    });
                }
            }
        }

        function remove(id) {
            let counter = $('#count').val();
            let days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

            $("#remove" + id).remove();

            let new_days = [];
            for (let index = 0; index <= counter; index++) {
                let new_values = $('#day_of_week' + index).val();
                if (new_values) {
                    for (let innerIndex = 0; innerIndex < new_values.length; innerIndex++) {
                        new_days.push(new_values[innerIndex]);
                    }
                }
            }

            for (let index = 0; index <= counter; index++) {
                let old_values = $('#day_of_week' + index).val();
                if (old_values) {
                    let new_array = days.filter(day => !new_days.includes(day));

                    $('#day_of_week' + index).empty();

                    old_values.forEach(old_value => {
                        $('#day_of_week' + index).append($('<option></option>').attr('value', old_value).text(
                                old_value)
                            .prop('selected', true));
                    });

                    new_array.forEach(new_value => {
                        $('#day_of_week' + index).append($('<option></option>').attr('value', new_value).text(
                            new_value));
                    });
                }
            }
        }


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

            $('#galleryInput').change(function() {
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
