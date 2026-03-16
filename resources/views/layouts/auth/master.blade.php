<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.app.css')
    @yield('css')

</head>

<body>

    {{-- <div class="page-wrapper compact-wrapper" id="pageWrapper"> --}}

    <!-- header area -->
    {{-- @include('admin.layouts.header') --}}
    <!-- header area end -->

     {{-- <div class="page-body-wrapper"> --}}


    <!-- sidebar-popup -->
    {{-- @include('admin.layouts.sidebar') --}}
    <!-- sidebar-popup end -->


     <div class="page-body">
        <!-- Breadcrumb -->
        {{-- @yield('breadcrumbs') --}}
        <!-- / Breadcrumb -->

        @yield('content')
     </div>



    <!-- footer area -->
    {{-- @include('layouts.app.footer') --}}
    <!-- footer area end -->

{{-- </div>
    </div> --}}


    <!-- scroll-top -->
    {{-- <div class="tap-top"><i data-feather="chevrons-up"></i></div> --}}
    <!-- scroll-top end -->


    <!-- js -->
    {{-- @include('layouts.app.script') --}}


      <script src="{{asset('AdminAssets/js/jquery.min.js')}}"></script>
      <script src="{{asset('AdminAssets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('AdminAssets/js/icons/feather-icon/feather.min.js')}}"></script>
      <script src="{{asset('AdminAssets/js/icons/feather-icon/feather-icon.js')}}"></script>
      <script src="{{asset('AdminAssets/js/config.js')}}"></script>
      <script src="{{asset('AdminAssets/js/script.js')}}"></script>
      <script src="{{asset('AdminAssets/js/script1.js')}}"></script>

</body>

</html>
