<x-main::admin-layout>
    @section('title')
        @yield('title')
    @endsection

    @section('header-description')
        @yield('header-description')
    @endsection

    @section('hero-start')
        @yield('hero-start-section')
    @endsection

    @section('hero-end')
        @yield('hero-end-section')
    @endsection

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="">
            @if(View::hasSection('form'))
                <x-main::box>
                    <h2 class="mb-6">
                        {{__('create new item')}}
                    </h2>
                    <form method="POST" action="@yield('formRoute')" id="createForm">
                        @csrf
                        @yield('form')
                        <div class="flex items-center justify-end">
                            <x-main::button.primary type="submit" role="submit">
                                {{__('add')}}
                            </x-main::button.primary>
                        </div>
                    </form>
                </x-main::box>
            @endif
            @yield('start-column')
        </div>

        <div class="lg:col-span-2 flex flex-col gap-6">
            @yield('index')
        </div>
    </div>
</x-main::admin-layout>
