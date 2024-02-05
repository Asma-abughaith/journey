@extends('admin.master')
@section('title',"Admin | Dashboard")
@section('dashboard-active' , 'active')
@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            @include('layouts.admin.title', ['title' => __('app.dashboard')])
            <!-- end page title -->


        </div>

    </div>
    <!-- End Page-content -->

    @include('layouts.admin.footer')

</div>

@endsection
