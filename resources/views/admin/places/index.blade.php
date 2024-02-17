@extends('admin.master')
@section('title', __('app.dashboard-place'))
@section('place-active', 'active')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                @include('layouts.admin.title', ['title' => __('app.places')])
                <!-- end page title -->

                <div class="row" style="margin-top: 2.5%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title"></h4>
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('app.id') }}</th>
                                            <th class="text-center">{{ __('app.name') }}</th>
                                            <th class="text-center">{{ __('app.description') }}</th>
                                            <th class="text-center">{{ __('app.address') }}</th>
                                            <th class="text-center">{{ __('app.phone-number') }}</th>
                                            <th class="text-center">{{ __('app.longitude') }}</th>
                                            <th class="text-center">{{ __('app.latitude') }}</th>
                                            <th class="text-center">{{ __('app.price-level') }}</th>
                                            <th class="text-center">{{ __('app.website') }}</th>
                                            <th class="text-center">{{ __('app.rating') }}</th>
                                            <th class="text-center">{{ __('app.total-user-rating') }}</th>
                                            <th class="text-center">{{ __('app.sub-categories') }}</th>
                                            <th class="text-center">{{ __('app.regions') }}</th>
                                            <th class="text-center">{{ __('app.business-status') }}</th>
                                            <th class="text-center">{{ __('app.tags') }}</th>
                                            <th class="text-center">{{ __('app.features') }}</th>
                                            <th class="text-center">{{ __('app.image') }}</th>
                                            <th class="text-center">{{ __('app.gallery-images') }}</th>
                                            <th class="text-center">{{ __('app.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($places as $key => $place)
                                            <tr>
                                                <td class="text-center col-1">{{ ++$key }}</td>
                                                <td class="text-center col-2">{{ $place['name'] }}</td>
                                                <td class="text-center col-2">{{ Str::limit($place['description'], 70) }}
                                                </td>
                                                <td class="text-center col-2">{{ $place['address'] }}</td>
                                                <td class="text-center col-2">{{ $place['phone_number'] }}</td>
                                                <td class="text-center col-2">{{ $place['longitude'] }}</td>
                                                <td class="text-center col-2">{{ $place['latitude'] }}</td>
                                                <td class="text-center col-2">{{ $place['price_level'] }}</td>
                                                <td class="text-center col-2">{{ $place['website'] }}</td>
                                                <td class="text-center col-2">{{ $place['rating'] }}</td>
                                                <td class="text-center col-2">{{ $place['total_user_rating'] }}</td>
                                                <td class="text-center col-2">{{ $place['sub_category'] }}</td>
                                                <td class="text-center col-2">{{ $place['region'] }}</td>
                                                <td class="text-center col-2">{{ $place['business_status'] }}</td>
                                                <td class="text-center col-2">
                                                    @foreach ($place['tags'] as $tag)
                                                        <span class="badge badge-soft-info">{{ $tag['name'] }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="text-center col-2">
                                                    @foreach ($place['features'] as $feature)
                                                        <span class="badge badge-soft-dark">{{ $feature['name'] }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="text-center col-2"><img
                                                        src="{{ $place['main_image'] != null ? asset($place['main_image']) : asset('category.jpg') }}"
                                                        alt="{{ $place['main_image'] != null ? $place['name'] : 'avatar' }}"
                                                        width="50px" height="50px">
                                                </td>

                                                <td class="text-center col-2">
                                                    @foreach ($place['gallery'] as $gallery)
                                                        <img src="{{ $gallery != null ? asset($gallery) : asset('category.jpg') }}"
                                                            alt="{{ $gallery != null ? $place['name'] : 'avatar' }}"
                                                            width="50px" height="50px">
                                                    @endforeach
                                                </td>

                                                <td class="text-center col-2">
                                                    {{-- @if (AdminPermission('edit place')) --}}
                                                    <a class="btn btn-outline-warning btn-sm edit" title="Edit"
                                                        href="{{ route('admin.places.edit', $place['id']) }}">
                                                        <i class="fas fa-pencil-alt" title="Edit"></i>
                                                    </a>
                                                    {{-- @endif --}}

                                                    {{-- @if (AdminPermission('delete place')) --}}
                                                    <form method="post"
                                                        action="{{ route('admin.places.destroy', $place['id']) }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            title="Delete" style="padding-bottom: 1px;"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="ri-delete-bin-line" title="Edit"></i>
                                                        </button>
                                                    </form>
                                                    {{-- @endif --}}
                                                </td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
        <!-- End Page-content -->
        @include('layouts.admin.footer')
    </div>
@endsection

@push('script')
    <!-- Buttons examples -->
    <script src="{{ asset('assets') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/libs/jszip/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('assets') }}/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{ asset('assets') }}/js/pages/datatables.init.js"></script>
@endpush
