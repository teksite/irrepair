<x-main::admin-editor-layout :instance="$post" method="PATCH">
    @section('title',__('edit :title',['title'=>__('post')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('post'),'item'=>$post->title]))
    @section('formRoute',route('admin.blog.posts.update', $post))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.blog.posts.index')" :title="__('all :title',['title'=>__('posts')])" />
        @can('post-create')
            <x-main::link.header :href="route('admin.blog.posts.create')" :title="__('new :title',['title'=>__('post')])" />
        @endcan
    @endsection
    @section('hero-end-section')
        @can('post-delete')
            <x-main::link.delete :route="route('admin.blog.posts.destroy' , $post)" title="{{$post->title}}"/>
        @endcan
    @endsection
    @section('top')
        @include('main::layouts.admin.sections.title',['instance'=>$post])
        @include('main::layouts.admin.sections.slug',['instance'=>$post])
    @endsection
    @section('main')
        @include('main::layouts.admin.sections.text',['name'=>'excerpt' ,'column'=>'excerpt' ,'title'=>__('excerpt'),'instance'=>$post])
        @include('main::layouts.admin.sections.text-editor',['name'=>'body' ,'column'=>'body' ,'title'=>__('body'),'instance'=>$post])
        @include('main::layouts.admin.sections.seo',['instance'=>$post])
    @endsection
    @section('aside')
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'featured_image', 'title'=>'featured_image', 'column'=>'featured_image','instance'=>$post])
        @include('blog::layouts.admin.sections.categories',['open'=>'true','instance'=>$post])
        @include('main::layouts.admin.sections.template',['open'=>'true','path'=>'resources/views/pages/posts/templates', 'instance'=>$post])
        @include('main::layouts.admin.sections.tags',['open'=>'false','instance'=>$post])
        @include('main::layouts.admin.sections.publish-status',['open'=>'false','instance'=>$post])
    @endsection

</x-main::admin-editor-layout>
