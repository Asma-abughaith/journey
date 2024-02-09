@extends('admin.master')
@section('title',"Admin | roles")
@section('role-active' , 'active')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                @include('layouts.admin.title', ['title' => __('app.roles')])
                <!-- end page title -->

                <div class="row" style="margin-top: 2.5%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title"></h4>
{{--                                <p class="card-title-desc"></p>--}}

                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{__('app.id')}}</th>
                                        <th class="text-center">{{__('app.name')}}</th>
                                        <th class="text-center">{{__('app.guard')}}</th>
                                        <th class="text-center">{{__('app.action')}}</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td class="text-center col-1">{{ $role['id'] }}</td>
                                            <td class="text-center col-4">{{ $role['name_i18n'] }}</td>
                                            <td class="text-center col-4">{{ $role['guard_name'] }}</td>
                                            <td class="text-center col-3">
                                                <a href="{{ route('admin.roles.edit', $role['id']) }}" class="edit btn btn-warning btn-sm"><i class="ri-edit-line"></i></a>
                                                <form method="post" action="{{ route('admin.roles.destroy', $role['id']) }}" style="display:inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="ri-delete-bin-line"></i></button>
                                                </form>
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
    <script src="{{asset('assets')}}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('assets')}}/libs/jszip/jszip.min.js"></script>
    <script src="{{asset('assets')}}/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{asset('assets')}}/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/datatables.init.js"></script>

@endpush
