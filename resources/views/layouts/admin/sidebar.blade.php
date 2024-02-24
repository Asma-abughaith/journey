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

                {{--                @if (AdminPermission('view admins') || AdminPermission('create admins')) --}}
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect" @yield('dashboard-active')>
                        <i class="ri-dashboard-line"></i>
                        <span>{{ __('app.dashboard') }}</span>
                    </a>
                </li>
                {{--                @endif --}}

                {{--                @if (AdminPermission('view permissions') || AdminPermission('create permission')) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('permission-active')>
                        <i class="ri-ghost-2-fill"></i>
                        <span>{{ __('app.permissions') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view permissions')) --}}
                        <li><a href="{{ route('admin.permissions.index') }}">{{ __('app.all-permissions') }}</a></li>
                        {{--                        @endif --}}
                        {{--                        @if (AdminPermission('create permission')) --}}
                        <li><a href="{{ route('admin.permissions.create') }}">{{ __('app.create-permission') }}</a>
                        </li>
                        {{--                        @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}

                {{--                @if (AdminPermission('view roles') || AdminPermission('create role')) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('role-active')>
                        <i class="ri-spy-fill"></i>
                        <span>{{ __('app.roles') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view roles')) --}}
                        <li><a href="{{ route('admin.roles.index') }}">{{ __('app.all-roles') }}</a></li>
                        {{--                        @endif --}}
                        {{--                        @if (AdminPermission('create role')) --}}
                        <li><a href="{{ route('admin.roles.create') }}">{{ __('app.create-role') }}</a></li>
                        {{--                        @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}

                {{--                @if (AdminPermission('view admins') || AdminPermission('create admins')) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect @yield('admins-active')">
                        <i class="ri-admin-line"></i>
                        <span>{{ __('app.admins') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view admins')) --}}
                        <li><a href="{{ route('admin.admins.index') }}">{{ __('app.all-admins') }}</a></li>
                        {{--                        @endif --}}
                        {{--                        @if (AdminPermission('create admin')) --}}
                        <li><a href="{{ route('admin.admins.create') }}">{{ __('app.create-admin') }}</a></li>
                        {{--                            @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}

                {{--                @if (AdminPermission('view categories') || AdminPermission('create category')) --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('category-active')>
                        <i class="ri-list-ordered"></i>
                        <span>{{ __('app.categories') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view categories')) --}}
                        <li><a href="{{ route('admin.categories.index') }}">{{ __('app.all-categories') }}</a></li>
                        {{--                        @endif --}}
                        {{--                        @if (AdminPermission('create category')) --}}
                        <li><a href="{{ route('admin.categories.create') }}">{{ __('app.create-category') }}</a></li>
                        {{--                            @endif --}}
                    </ul>
                </li>
                {{--                @if (AdminPermission('view subcategories') || AdminPermission('create subcategory')) --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('subCategory-active')>
                        <i class=" ri-layout-masonry-fill"></i>
                        <span>{{ __('app.sub-categories') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view subcategories')) --}}
                        <li><a href="{{ route('admin.sub_categories.index') }}">{{ __('app.all-sub-categories') }}</a>
                        </li>
                        {{--                        @endif --}}
                        {{--                            @if (AdminPermission('create subcategory')) --}}
                        <li><a
                                href="{{ route('admin.sub_categories.create') }}">{{ __('app.create-sub-categories') }}</a>
                        </li>
                        {{--                    @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}


                {{--                @if (AdminPermission('view regions') || AdminPermission('create region')) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('region-active')>
                        <i class="ri-map-pin-fill"></i>
                        <span>{{ __('app.regions') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view regions')) --}}
                        <li><a href="{{ route('admin.regions.index') }}">{{ __('app.all-regions') }}</a></li>
                        {{--                        @endif --}}
                        {{--                            @if (AdminPermission('create region')) --}}
                        <li><a href="{{ route('admin.regions.create') }}">{{ __('app.create-region') }}</a></li>
                        {{--                    @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}


                {{--                @if (AdminPermission('view features') || AdminPermission('create feature')) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('feature-active')>
                        <i class="mdi mdi-offer"></i>
                        <span>{{ __('app.features') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view feature')) --}}
                        <li><a href="{{ route('admin.features.index') }}">{{ __('app.all-features') }}</a></li>
                        {{--                        @endif --}}
                        {{--                            @if (AdminPermission('create feature')) --}}
                        <li><a href="{{ route('admin.features.create') }}">{{ __('app.create-feature') }}</a></li>
                        {{--                    @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}

                {{--                @if (AdminPermission('view tags') || AdminPermission('create tag')) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('tag-active')>
                        <i class="ri-mark-pen-fill"></i>
                        <span>{{ __('app.tags') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view tags')) --}}
                        <li><a href="{{ route('admin.tags.index') }}">{{ __('app.all-tags') }}</a></li>
                        {{--                        @endif --}}
                        {{--                            @if (AdminPermission('create tag')) --}}
                        <li><a href="{{ route('admin.tags.create') }}">{{ __('app.create-tag') }}</a></li>
                        {{--                    @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}

                {{--                @if (AdminPermission('view places') || AdminPermission('create place')) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('place-active')>
                        <i class="ri-home-heart-fill"></i>
                        <span>{{ __('app.places') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view places')) --}}
                        <li><a href="{{ route('admin.places.index') }}">{{ __('app.all-places') }}</a></li>
                        {{--                        @endif --}}
                        {{--                            @if (AdminPermission('create place')) --}}
                        <li><a href="{{ route('admin.places.create') }}">{{ __('app.create-place') }}</a></li>
                        {{--                    @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}

                {{--                @if (AdminPermission('view topTenPlaces') || AdminPermission('create topTenPlace')) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('topTen-active')>
                        <i class="ri-home-heart-fill"></i>
                        <span>{{ __('app.topTenPlaces') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view topTenPlaces')) --}}
                        <li><a href="{{ route('admin.topTenPlaces.index') }}">{{ __('app.all-topTenPlaces') }}</a></li>
                        {{--                        @endif --}}
                        {{--                            @if (AdminPermission('create topTenPlace')) --}}
                        <li><a href="{{ route('admin.topTenPlaces.create') }}">{{ __('app.create-topTenPlaces') }}</a></li>
                        {{--                    @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}

                {{--                @if (AdminPermission('view popularPlaces') || AdminPermission('create popularPlace')) --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect" @yield('topTen-active')>
                        <i class="ri-home-heart-fill"></i>
                        <span>{{ __('app.popularPlaces') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--                        @if (AdminPermission('view popularPlaces')) --}}
                        <li><a href="{{ route('admin.popularPlaces.index') }}">{{ __('app.all-popularPlaces') }}</a></li>
                        {{--                        @endif --}}
                        {{--                            @if (AdminPermission('create popularPlace')) --}}
                        <li><a href="{{ route('admin.popularPlaces.create') }}">{{ __('app.create-popularPlaces') }}</a></li>
                        {{--                    @endif --}}
                    </ul>
                </li>
                {{--                @endif --}}


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
