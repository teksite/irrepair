<x-main::admin-editor-layout>
    @section('title' , __('new :title',['title'=>__('article')]))
    @section('formRoute',route('admin.blog.articles.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('article')]))
    @section('hero-start-section')
        <x-main::link.header :title="__('all :title',['title' =>__('articles')])" :href="route('admin.blog.articles.index')"/>
    @endsection
    @section('hero-end-section')
    @endsection
    @section('top')
            @include('main::layouts.admin.sections.title')
    @endsection
    @section('main')
        @include('main::layouts.admin.sections.text',['name'=>'excerpt' ,'column'=>'excerpt' ,'title'=>__('excerpt')])
        @include('main::layouts.admin.sections.text-editor',['name'=>'body' ,'column'=>'body' ,'title'=>__('body')])
    @endsection
    @section('aside')
        @include('main::layouts.admin.sections.publish',['open'=>'false'])
    @endsection

</x-main::admin-editor-layout>
