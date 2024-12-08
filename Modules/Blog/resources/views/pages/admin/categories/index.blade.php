<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('articles')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('categories')]))

    @section('hero-start-section')
        @can('article-create')
            <x-main::link.header :title="__('new :title',['title' =>__('category')])" :href="route('admin.blog.categories.create')"/>
        @endcan
    @endsection
    @section('hero-end-section')
        <x-main::search/>
    @endsection

    @section('main')

        @include('blog::layouts.admin.sections.categories-tree' ,['open'=>'true' ,'title'=>'all categories','instance'=>$categories])

    @endsection

</x-main::admin-list-layout>


