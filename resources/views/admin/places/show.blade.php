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
                                <div class="col-md-8">
                                    <h2>{{ $place['name'] }}</h2>
                                    <p>{{ $place['description'] }}</p>
                                    <p><strong>Address:</strong> {{ $place['address'] }}</p>
                                    <p><strong>Business Status:</strong> {{ $place['business_status'] }}</p>
                                    <p><strong>Google Map URL:</strong> <a href="{{ $place['google_map_url'] }}">{{ $place['google_map_url'] }}</a></p>
                                    <p><strong>Phone Number:</strong> {{ $place['phone_number'] }}</p>
                                    <p><strong>Price Level:</strong> {{ $place['price_level'] }}</p>
                                    <p><strong>Website:</strong> <a href="{{ $place['website'] }}">{{ $place['website'] }}</a></p>
                                    <p><strong>Rating:</strong> {{ $place['rating'] }}</p>
                                    <p><strong>Total User Rating:</strong> {{ $place['total_user_rating'] }}</p>
                                    <p><strong>Region:</strong> {{ $place['region'] }}</p>

                                    {{-- Display main image --}}
                                    <img src="{{ $place['main_image'] }}" alt="Main Image" class="img-fluid">

                                    {{-- Display gallery images --}}
                                    <h3>Gallery</h3>
                                    <div class="row">
                                        @foreach($place['gallery'] as $image)
                                            <div class="col-md-3">
                                                <img src="{{ $image }}" alt="Gallery Image" class="img-fluid">
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Display tags --}}
                                    <h3>Tags</h3>
                                    <ul>
                                        @foreach($place['tags'] as $tag)
                                            <li>{{ $tag['name'] }}</li>
                                        @endforeach
                                    </ul>

                                    {{-- Display features --}}
                                    <h3>Features</h3>
                                    <ul>
                                        @foreach($place['features'] as $feature)
                                            <li>{{ $feature['name'] }}</li>
                                        @endforeach
                                    </ul>

                                    {{-- Display opening hours --}}
                                    <h3>Opening Hours</h3>
                                    <ul>
                                        @foreach($place['opening_hours'] as $hours)
                                            @foreach($hours as $hour)
                                                <li>{{ $hour['day_of_week'] }}: {{ $hour['opening_time'] }} - {{ $hour['closing_time'] }}</li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </div>
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
