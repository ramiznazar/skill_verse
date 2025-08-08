@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<div class="main">
    @yield('content')
</div>

@include('admin.layouts.script')
@yield('additional-javascript')
