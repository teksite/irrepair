<x-main::admin-layout>
    @section('title')
        @yield('title')
    @endsection

    @section('header-description')
        @yield('header-description-section')
    @endsection

    @section('hero-start')
        @yield('hero-start-section')
    @endsection

    @section('hero-end')
        @yield('hero-end-section')
    @endsection

    @yield('main')
</x-main::admin-layout>
