<x-main::admin-editor-layout :instance="$article" method="PATCH">
    @section('title',__('edit :title',['title'=>__('article')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('article'),'item'=>$article->title]))
    @section('formRoute',route('admin.blog.articles.update', $article))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.blog.articles.index')" :title="__('all :title',['title'=>__('articles')])" />
        @can('article-create')
            <x-main::link.header :href="route('admin.blog.articles.create')" :title="__('new :title',['title'=>__('article')])" />
        @endcan
    @endsection
    @section('hero-end-section')
        @can('article-delete')
            <x-main::link.delete :route="route('admin.blog.articles.destroy' , $article)" title="{{$article->title}}"/>
        @endcan
    @endsection
    @section('top')
        @include('main::layouts.admin.sections.title',['instance'=>$article])
    @endsection
    @section('main')
        @include('main::layouts.admin.sections.text',['name'=>'excerpt' ,'column'=>'excerpt' ,'title'=>__('excerpt'),'instance'=>$article])
        @include('main::layouts.admin.sections.text-editor',['name'=>'body' ,'column'=>'body' ,'title'=>__('body'),'instance'=>$article])
    @endsection
    @section('aside')
        @include('main::layouts.admin.sections.publish',['open'=>'false','instance'=>$article])
    @endsection

</x-main::admin-editor-layout>
