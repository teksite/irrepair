<x-main::admin-editor-layout>
    @section('title' , __('new :title',['title'=>__('page')]))
    @section('formRoute',route('admin.pages.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('page')]))
    @section('hero-start-section')
        <x-main::link.header :title="__('all :title',['title' =>__('pages')])" :href="route('admin.pages.index')"/>
    @endsection
    @section('hero-end-section')
    @endsection
    @section('top')
            @include('main::layouts.admin.sections.title')
            @include('main::layouts.admin.sections.slug')
    @endsection
    @section('main')
        @include('main::layouts.admin.sections.text',['name'=>'excerpt' ,'column'=>'excerpt' ,'title'=>__('excerpt')])
        @include('main::layouts.admin.sections.text-editor',['name'=>'body' ,'column'=>'body' ,'title'=>__('body')])
        @include('main::layouts.admin.sections.seo')
    @endsection
    @section('aside')
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'featured_image', 'title'=>'featured_image', 'column'=>'featured_image'])
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'banner', 'title'=>'banner', 'column'=>'banner'])
        @include('main::layouts.admin.sections.tags',['open'=>'false'])
        @include('main::layouts.admin.sections.publish-status',['open'=>'false'])
    @endsection

</x-main::admin-editor-layout>