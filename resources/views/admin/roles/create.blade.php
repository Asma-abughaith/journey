@extends('admin.master')
@section('title',"Admin | roles")
@section('permission-active' , 'active')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                @include('layouts.admin.title', ['title' => __('app.create-permission')])
                <!-- end page title -->

                <div class="col-xl-12 mx-auto" style="margin-top: 2.5%;">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"></h4>

                            <form method="post" action="{{route('admin.roles.store')}}" >
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label  class="form-label">{{__('app.name-en')}}</label>
                                            <input type="text" class="form-control"  placeholder="{{__('app.role-en')}}" name='name_en' required >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label  class="form-label">{{__('app.name-ar')}}</label>
                                            <input type="text" class="form-control"  placeholder="{{__('app.role-ar')}}" name='name_ar' required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('app.guard')}}</label>
                                            <select class="form-select"  required="" name="guard"  >
                                                <option  selected>{{__('app.select-one')}}</option>
                                                <option value="admin" >{{__('app.admin')}}</option>
                                                <option value="planner">{{__('app.planner')}}</option>
                                                <option value="user">{{__('app.user')}}</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                    <div class="col-md-6">
                                        @foreach($permissions as $permission)
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="{{ $permission['name'] }}" name="permissions" value="{{ $permission['name'] }}">
                                                <label class="form-check-label" for="{{ $permission['name'] }}">{{ $permission['name_i18n'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">{{__('app.submit')}}</button>
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


