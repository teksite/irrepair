<x-main::admin-layout>
    @section('title' , __('dashboard'))
    <div class="grid gap-6 md:grid-cols-2  2xl:grid-cols-3">
        {!! Module::getMenu('admin','dashboard') !!}

    </div>
</x-main::admin-layout>
