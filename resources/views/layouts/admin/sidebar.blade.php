@php
    $admin = \Illuminate\Support\Facades\Auth::guard('admin')->user();
@endphp

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('assets') }}/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    {{ __('app.online') }}</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">{{ __('app.menu') }}</li>

{{--                @if(AdminPermission('view admins')||AdminPermission('create admins') )--}}
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect" @yield('dashboard-active')>
                        <i class="ri-dashboard-line"></i>
                        <span>{{ __('app.dashboard') }}</span>
                    </a>
                </li>
{{--                @endif--}}

{{--                @if(AdminPermission('view permissions')||AdminPermission('create permission') )--}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('permission-active')>
                        <i class="ri-ghost-2-fill"></i>
                        <span>{{ __('app.permissions') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
{{--                        @if(AdminPermission('view permissions') )--}}
                        <li><a href="{{ route('admin.permissions.index') }}">{{ __('app.all-permissions') }}</a></li>
{{--                        @endif--}}
{{--                        @if(AdminPermission('create permission') )--}}
                        <li><a href="{{ route('admin.permissions.create') }}">{{ __('app.create-permission') }}</a>
                        </li>
{{--                        @endif--}}
                    </ul>
                </li>
{{--                @endif--}}

{{--                @if(AdminPermission('view roles')||AdminPermission('create role') )--}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('role-active')>
                        <i class="ri-spy-fill"></i>
                        <span>{{ __('app.roles') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
{{--                        @if(AdminPermission('view roles') )--}}
                        <li><a href="{{ route('admin.roles.index') }}">{{ __('app.all-roles') }}</a></li>
{{--                        @endif--}}
{{--                        @if(AdminPermission('create role') )--}}
                        <li><a href="{{ route('admin.roles.create') }}">{{ __('app.create-role') }}</a></li>
{{--                        @endif--}}
                    </ul>
                </li>
{{--                @endif--}}

{{--                @if(AdminPermission('view admins')||AdminPermission('create admins') )--}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('admins-active')>
                        <i class="ri-admin-line"></i>
                        <span>{{ __('app.admins') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
{{--                        @if(AdminPermission('view admins') )--}}
                        <li><a href="{{ route('admin.admins.index') }}">{{ __('app.all-admins') }}</a></li>
{{--                        @endif--}}
{{--                        @if(AdminPermission('create admin') )--}}
                        <li><a href="{{ route('admin.admins.create') }}">{{ __('app.create-admin') }}</a></li>
{{--                            @endif--}}
                    </ul>
                </li>
{{--                @endif--}}

{{--                @if(AdminPermission('view categories')||AdminPermission('create category') )--}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('category-active')>
                        <i class="ri-list-ordered"></i>
                        <span>{{ __('app.categories') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
{{--                        @if(AdminPermission('view categories') )--}}
                        <li><a href="{{ route('admin.categories.index') }}">{{ __('app.all-categories') }}</a></li>
{{--                        @endif--}}
{{--                        @if(AdminPermission('create category'))--}}
                        <li><a href="{{ route('admin.categories.create') }}">{{ __('app.create-category') }}</a></li>
{{--                            @endif--}}
                    </ul>
                </li>
                {{--                @if(AdminPermission('view subcategories')||AdminPermission('create subcategory') )--}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('subCategory-active')>
                        <i class="ri-list-ordered"></i>
                        <span>{{ __('app.sub-categories') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
{{--                        @if(AdminPermission('view subcategories'))--}}
                        <li><a href="{{ route('admin.sub_categories.index') }}">{{ __('app.all-sub-categories') }}</a></li>
{{--                        @endif--}}
{{--                            @if(AdminPermission('create subcategory'))--}}
                            <li><a href="{{ route('admin.sub_categories.create') }}">{{ __('app.create-sub-categories') }}</a></li>
{{--                    @endif--}}
                    </ul>
                </li>
{{--                @endif--}}


{{--                @if(AdminPermission('view regions')||AdminPermission('create region') )--}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('region-active')>
                        <i class="dripicons-location"></i>
                        <span>{{ __('app.regions') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if(AdminPermission('view regions'))--}}
                        <li><a href="{{ route('admin.regions.index') }}">{{ __('app.all-regions') }}</a></li>
                        {{--                        @endif--}}
                        {{--                            @if(AdminPermission('create region'))--}}
                        <li><a href="{{ route('admin.regions.create') }}">{{ __('app.create-region') }}</a></li>
                        {{--                    @endif--}}
                    </ul>
                </li>
{{--                @endif--}}


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
