@extends('admin.master')
@section('title', __('app.dashboard-trips'))
@section('trips-active', 'active')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                @include('layouts.admin.title', ['title' => __('app.trips')])
                <!-- end page title -->

                <div class="row" style="margin-top: 2.5%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title"></h4>
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('app.id') }}</th>
                                            <th class="text-center">{{ __('app.name') }}</th>
                                            <th class="text-center">{{ __('app.description') }}</th>
                                            <th class="text-center">{{ __('app.place') }}</th>
                                            <th class="text-center">{{ __('app.datetime') }}</th>
                                            <th class="text-center">{{ __('app.status') }}</th>
                                            <th class="text-center">{{ __('app.action') }}</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($trips as $key => $trip)
                                            <tr>
                                                <td class="text-center col-1">{{ ++$key }}</td>
                                                <td class="text-center col-2">{{ $trip['name'] }}</td>
                                                <td class="text-center col-2">{{ $trip['description'] }}</td>
                                                <td class="text-center col-2">{{ $trip['place'] }}</td>
                                                <td class="text-center col-2">{{ $trip['datetime'] }}</td>
                                                <td class="text-center col-2">
                                                    {{ $trip['status'] == 1 ? __('app.active') : __('app.inactive') }}
                                                </td>

                                                <td class="text-center col-2">


                                                    {{--                                                    @if (AdminPermission('view events')) --}}
                                                    <a class="btn btn-outline-primary btn-sm" title="Show" href="{{ route('admin.trips.show', $trip['id']) }}">
                                                        <i class="fas fa-eye" title="show"></i>
                                                    </a>
                                                    {{--                                                    @endif --}}

                                                    {{--                                                        @if (AdminPermission('delete event')) --}}
                                                    <form method="post" action="{{ route('admin.trips.destroy', $trip['id']) }}" style="display:inline;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete" style="padding-bottom: 1px;"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="ri-delete-bin-line" title="Edit"></i>
                                                        </button>
                                                    </form>

                                                    {{--                                                            @endif --}}
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
