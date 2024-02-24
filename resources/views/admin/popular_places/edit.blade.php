@extends('admin.master')
@section('title', __('app.dashboard-category'))
@section('popularPlace-active', 'active')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                @include('layouts.admin.title', ['title' => __('app.edit-popularPlace')])
                <!-- end page title -->

                <div class="col-xl-12 mx-auto" style="margin-top: 2.5%;">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"></h4>



                            <form method="post" action="{{ route('admin.popularPlaces.update', $popular['id']) }}">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $popular['id'] }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                   for="place_id">{{ __('app.places') }}</label>
                                            <select class="select2 form-control " name="place_id"
                                                    data-placeholder="{{ __('app.choose...') }}" required id="place_id">
                                                <option value="">{{ __('app.select-one') }}</option>
                                                @foreach ($places as $place)
                                                    <option value="{{ $place['id'] }}" @if( $place['name']==$popular['place']) selected @endif>{{ $place['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="price">{{ __('app.rank') }}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{ __('app.rank') }}" name="price"
                                                   value="{{ old('price',$popular['price']) }}" id="price" required>
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
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageInput').change(function() {
                displayImagePreview(this);
            });

            function displayImagePreview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#previewImage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endpush
