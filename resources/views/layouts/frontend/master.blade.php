<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.frontend.meta')
    @include('layouts.frontend.css')
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    @include('layouts.frontend.preheader')
    @include('layouts.frontend.header')

    @yield('content')
    
    @include('layouts.frontend.musicplayer')
    @include('layouts.frontend.footer')
    @include('layouts.frontend.script')
    @yield('script')





</body>

</html>
