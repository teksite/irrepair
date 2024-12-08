<x-main::admin-editor-layout :instance="$widget" method="PATCH">
    @section('title',__('edit :title',['title'=>__('widget')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('widget'),'item'=>$widget->title]))
    @section('formRoute',route('admin.widgets.update', $widget))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.widgets.index')" :title="__('all :title',['title'=>__('widgets')])" />
        @can('widget-create')
            <x-main::link.header :href="route('admin.widgets.create')" :title="__('new :title',['title'=>__('widget')])" />
        @endcan
    @endsection
    @section('hero-end-section')
        @can('widget-delete')
            <x-main::link.delete :route="route('admin.widgets.destroy' , $widget)" title="{{$widget->title}}"/>
        @endcan
    @endsection

    @section('main')
        <x-main::box >
            <div class="my-3">
                <x-main::input.label for="label" value="{{__('label')}}"/>
                <x-main::input.text id="label" class="block mt-1 w-full" :readonly="true" :disabled="true" :value="$widget->label"/>
            </div>
            <div class="my-3">
                <x-main::input.label for="title" value="{{__('title')}}"/>
                <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title') ?? $widget->title"/>
                <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
            </div>

            <div class="my-3">
                <x-main::input.label for="description" value="{{__('body')}}"/>
                <x-main::input.textarea id="body" class="block mt-1 w-full" type="text" name="body" rows="15">{{old('body') ?? $widget->body ??  ''}}</x-main::input.textarea>
                <x-main::input.error :messages="$errors->get('body')" class="mt-2"/>
            </div>
        </x-main::box>
    @endsection

    @section('aside')
    @endsection

</x-main::admin-editor-layout>

