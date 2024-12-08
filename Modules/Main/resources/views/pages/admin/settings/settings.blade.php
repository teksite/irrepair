<x-main::admin-layout>
    @section('title' , __('site setting'))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('settings')]))

    <section class="mb-6 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <x-main::box class="lg:col-span-2">

        </x-main::box>
        <x-main::box class="">
            <form method="POST" action="{{route('admin.settings.resetSite')}}">
                @csrf
                    <span class="text-xs text-red-600 block mb-3">
                        {{__('caution')}}: {{__('resetting site causes wipe all data and restore backup data')}}
                    </span>
                    <x-main::button.danger>
                        {{__('reset ')}}
                    </x-main::button.danger>
            </form>
        </x-main::box>
    </section>

</x-main::admin-layout>
