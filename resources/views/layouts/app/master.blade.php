<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('layouts.app.meta')
    @include('layouts.app.css')
    @yield('css')

</head>

<body>

    <div class="page-wrapper compact-wrapper" id="pageWrapper">

    <!-- header area -->
    @include('layouts.app.header')
    <!-- header area end -->

     <div class="page-body-wrapper">


    <!-- sidebar-popup -->
    @include('layouts.app.sidebar')
    <!-- sidebar-popup end -->


     {{-- <div class="page-body"> --}}
        <!-- Breadcrumb -->
        {{-- @yield('breadcrumbs') --}}
        <!-- / Breadcrumb -->

        @yield('content')
     {{-- </div> --}}



    <!-- footer area -->
    @include('layouts.app.footer')
    <!-- footer area end -->

</div>
    </div>


    <!-- scroll-top -->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- scroll-top end -->


    <!-- js -->
    @include('layouts.app.script')

</body>

</html>
