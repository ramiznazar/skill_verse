@include('website.layouts.head')

@include('website.layouts.header')

<!-- Start main-content -->
@yield('content')

@include('website.layouts.footer')

@include('website.layouts.script')

@yield('additional-javascript')
