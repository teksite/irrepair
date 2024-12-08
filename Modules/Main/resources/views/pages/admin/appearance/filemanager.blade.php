<x-main::admin-layout>
    @section('title' , __('file manager'))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('files')]))


    <x-main::box dir="ltr" class="overflow-y-auto">
     {!! view('file-manager::fmButton') !!}
    </x-main::box>
</x-main::admin-layout>
