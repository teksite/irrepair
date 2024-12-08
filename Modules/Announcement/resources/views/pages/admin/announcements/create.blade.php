<x-main::admin-editor-layout>
    @section('title' , __('new :title',['title'=>__('announcement')]))
    @section('formRoute',route('admin.announcements.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('announcement')]))
    @section('hero-start-section')
        <x-main::link.header :title="__('all :title',['title' =>__('announcements')])" :href="route('admin.announcements.index')"/>
    @endsection
    @section('hero-end-section')
    @endsection
    @section('top')
            @include('main::layouts.admin.sections.title')
    @endsection
    @section('main')
        @include('main::layouts.admin.sections.text-editor',['name'=>'message' ,'column'=>'message' ,'title'=>__('message')])

    @endsection
    @section('aside')
        <div class="my-3">
            <div class="flex items-center gap-3">
                <x-main::input.checkbox id="pinned" name="pinned" value="on"/>
                <x-main::input.label class="!mb-0" for="pinned" :value="__('pinned')"/>
            </div>
            <x-main::input.error :messages="$errors->get('pinned')" class="mt-2"/>
        </div>
        @include('announcement::layouts.admin.sections.ways')
    @endsection

</x-main::admin-editor-layout>
