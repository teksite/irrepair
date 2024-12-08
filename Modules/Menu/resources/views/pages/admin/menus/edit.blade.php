<x-main::admin-editor-layout :instance="$menu" method="PATCH">
@section('title',__('edit :title',['title'=>__('menu')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('menu'),'item'=>$menu->title]))
    @section('formRoute',route('admin.appearance.menus.update', $menu))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.appearance.menus.index')" :title="__('all :title',['title'=>__('menus')])" />
        <x-main::link.header :href="route('admin.appearance.menus.items.index',$menu)" :title="__('all :title',['title'=>__('items')])" />
    @endsection
    @section('hero-end-section')
        @can('menu-delete')
            <x-main::link.delete :route="route('admin.appearance.menus.destroy' , $menu)" title="{{$menu->title}}"/>
        @endcan
    @endsection

    @section('main')
        <x-main::box class="grid gap-6 md:grid-cols-2">
            <div class="my-3">
                <x-main::input.label for="title" value="{{__('title')}}"/>
                <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title') ?? $menu->title"/>
                <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
            </div>
            <div class="my-3">
                <x-main::input.label for="label" value="{{__('label')}}"/>
                <x-main::input.text id="label" class="block mt-1 w-full" type="text" :value="$menu->label" :readonly="true" :disabled="true"/>
                <x-main::input.error :messages="$errors->get('label')" class="mt-2"/>
            </div>
            <div class="my-3">
                <x-main::input.label for="classes" value="{{__('classes')}}"/>
                <x-main::input.text id="classes" class="block mt-1 w-full" dir="ltr" type="text" name="classes" :value="old('classes') ?? $menu->classes"/>
                <x-main::input.error :messages="$errors->get('classes')" class="mt-2"/>
            </div>
        </x-main::box>
    @endsection

</x-main::admin-editor-layout>



