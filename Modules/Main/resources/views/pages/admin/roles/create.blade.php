<x-main::admin-editor-layout>
    @section('title' , __('new :title',['title'=>__('role')]))
    @section('formRoute',route('admin.roles.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('role')]))


    @section('hero-start-section')
        <x-main::link.header :title="__('all :title',['title' =>__('roles')])" :href="route('admin.roles.index')"/>
    @endsection
    @section('hero-end-section')

    @endsection

    @section('main')
        <x-main::box >
            <div class="my-3">
                <x-main::input.label for="title" value="{{__('title')}}"/>
                <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title')"/>
                <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
            </div>

            <div class="my-3">
                <x-main::input.label for="description" value="{{__('description')}}"/>
                <x-main::input.text id="description" class="block mt-1 w-full" type="text" name="description"
                                    :value="old('description')"/>
                <x-main::input.error :messages="$errors->get('description')" class="mt-2"/>
            </div>
        </x-main::box>
    @endsection


    @section('aside')
        @include('main::layouts.admin.sections.permissions', ['multiple'=>true ,'open'=>'true'])
    @endsection

</x-main::admin-editor-layout>
