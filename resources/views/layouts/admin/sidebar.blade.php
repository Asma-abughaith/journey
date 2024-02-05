@php
$admin = \Illuminate\Support\Facades\Auth::guard('admin')->user();
@endphp

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{asset('assets')}}/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> {{ __('app.online') }}</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">{{ __('app.menu') }}</li>

{{--                @if($admin->hasAnyPermission(['laith','view_admins']))--}}

{{--                @if(permission(['view_adminss','view_admins']))--}}

                <li>
                    <a href="{{route('admin.dashboard')}}" class="waves-effect" @yield('dashboard-active')>
                        <i class="ri-dashboard-line"></i>
                        <span>{{ __('app.dashboard') }}</span>
                    </a>
                </li>

{{--                @endif--}}
{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="ri-mail-send-line"></i>--}}
{{--                        <span>Admins</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{route('admin.admins.index')}}">Admin</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}


{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="ri-mail-send-line"></i>--}}
{{--                        <span>Permissions and Roles</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{route('admin.permissions.index')}}">Permissions</a></li>--}}
{{--                        <li><a href="{{route('admin.roles.index')}}">Roles</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
