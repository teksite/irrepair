<x-main::admin-editor-layout>
    @section('title' , __('new :title',['title'=>__('category')]))
    @section('formRoute',route('admin.blog.categories.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('category')]))


    @section('hero-start-section')
        <x-main::link.header :title="__(':title list',['title'=>__('categories')])" :href="route('admin.blog.categories.index')"/>
    @endsection
    @section('hero-end-section') @endsection

    @section('top')
        @include('main::layouts.admin.sections.title')
        @include('main::layouts.admin.sections.slug')
    @endsection

    @section('main')
        @include('blog::layouts.admin.sections.categories-creation' ,['open'=>'true' ,'title'=>'parent'])
        @include('main::layouts.admin.sections.text-editor' ,['open'=>'false' , ])
    @endsection


    @section('aside')
        @include('main::layouts.admin.sections.image' ,['open'=>'true' , 'column'=>'featured_image','title'=>'featured image',])
    @endsection

</x-main::admin-editor-layout>
