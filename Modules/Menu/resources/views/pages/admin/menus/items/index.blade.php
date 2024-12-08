<x-main::admin-credix-layout>
    @push('headerScripts')
        @vite(['Modules/Menu/resources/assets/css/app.css', 'Modules/Menu/resources/assets/js/app.js'])
    @endpush
    @section('title' , __('menu items of :title' ,['title'=>$menu->title]))
    @section('header-description' , __("in this window you can see all :title of :item", ['title'=>__('items') , 'item'=>$menu->title]))
    @section('formRoute',route('admin.appearance.menus.items.store',$menu))

    @section('hero-start-section')
        <x-main::link.header :title="__('all :title',['title' =>__('menus')])" :href="route('admin.appearance.menus.index')"/>
    @endsection
    @section('form')
        <div class="mb-3">
            <x-main::input.label for="title" value="{{__('title')}}"/>
            <x-main::input.text name="title" type="text" class="mb-3 w-full block" id="title"/>
            <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
        </div>
        <div class="mb-3">
            <x-main::input.label for="url" value="{{__('url')}}"/>
            <x-main::input.text name="url" class="mb-3 w-full block" id="url" dir="ltr"/>
            <x-main::input.error :messages="$errors->get('url')" class="mt-2"/>
        </div>
    @endsection
    @section('index')
        <div class="container md:col-span-4" id="menuLists">
            <form method="POST" action="{{route('admin.appearance.menus.items.update',$menu)}}">
                @csrf
                @method('PATCH')
                <div class="nested">
                    @include('menu::layouts.admin.sections.menu-item' ,['items'=>$items])
                </div>
                <div class="my-3 w-full flex justify-end items-center">
                    <x-main::button.primary>
                        {{__('update')}}
                    </x-main::button.primary>
                </div>
            </form>
        </div>
    @endsection
</x-main::admin-credix-layout>
