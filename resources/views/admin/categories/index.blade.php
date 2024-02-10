@extends('admin.master')
@section('title',"Admin | Category")
@section('category-active' , 'active')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                @include('layouts.admin.title', ['title' => __('app.categories')])
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
                                        <th class="text-center">{{__('app.image')}}</th>
                                        <th class="text-center">{{__('app.priority')}}</th>
                                        <th class="text-center">{{__('app.action')}}</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($categories as $key => $category)
                                        <tr>
                                            <td class="text-center col-1">{{ ++$key }}</td>
                                            <td class="text-center col-4">{{ $category['name'] }}</td>
                                            <td class="text-center col-4"><img
                                                    src="{{ $category['image'] != null ? asset($category['image']) : asset('category.jpg') }}"
                                                    alt="{{ $category['image'] != null ? $category['name'] : 'avatar' }}"
                                                    width="50px" height="50px">
                                            </td>
                                            <td class="text-center col-4">{{ $category['priority'] }}</td>
                                            <td class="text-center col-3">
                                                <a href="{{ route('admin.categories.edit', $category['id']) }}" class="edit btn btn-warning btn-sm"><i class="ri-edit-line"></i></a>
                                                <form method="post" action="{{ route('admin.categories.destroy', $category['id']) }}" style="display:inline;">
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
