<x-main::admin-editor-layout>
    @section('title' , __('new :title',['title'=>__('widget')]))
    @section('formRoute',route('admin.widgets.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('widget')]))


    @section('hero-start-section')
        <x-main::link.header :title="__('all :title',['title' =>__('widgets')])" :href="route('admin.widgets.index')"/>

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
                <x-main::input.label for="description" value="{{__('body')}}"/>
                <x-main::input.textarea id="body" class="block mt-1 w-full" type="text" name="body" rows="15">{{old('body') ?? ''}}</x-main::input.textarea>
                <x-main::input.error :messages="$errors->get('body')" class="mt-2"/>
            </div>
        </x-main::box>
    @endsection


</x-main::admin-editor-layout>
