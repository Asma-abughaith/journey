<!doctype html>
<html lang="en" dir="{{ LaravelLocalization::getCurrentLocale() =='ar'?'rtl':'' }}">

@include('layouts.admin.head')
<body data-topbar="dark" style="background-color:#eff3f6; " >

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">


@include('layouts.admin.header')
    <!-- ========== Left Sidebar Start ========== -->
    @include('layouts.admin.sidebar')
    <!-- Left Sidebar End -->
    @yield('content')


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
@include('layouts.admin.script')
@stack('script')
</body>

</html>
