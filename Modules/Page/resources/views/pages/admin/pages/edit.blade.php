<x-main::admin-editor-layout :instance="$page" method="PATCH">
    @section('title',__('edit :title',['title'=>__('page')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('page'),'item'=>$page->title]))
    @section('formRoute',route('admin.pages.update', $page))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.pages.index')" :title="__('all :title',['title'=>__('pages')])" />
        @can('page-create')
            <x-main::link.header :href="route('admin.pages.create')" :title="__('new :title',['title'=>__('page')])" />
        @endcan
    @endsection
    @section('hero-end-section')
        @can('page-delete')
            <x-main::link.delete :route="route('admin.pages.destroy' , $page)" title="{{$page->title}}"/>
        @endcan
    @endsection
    @section('top')
        @include('main::layouts.admin.sections.title',['instance'=>$page])
        @include('main::layouts.admin.sections.slug',['instance'=>$page])
    @endsection
    @section('main')
        @include('main::layouts.admin.sections.text',['name'=>'excerpt' ,'column'=>'excerpt' ,'title'=>__('excerpt'),'instance'=>$page])
        @include('main::layouts.admin.sections.text-editor',['name'=>'body' ,'column'=>'body' ,'title'=>__('body'),'instance'=>$page])
        @include('main::layouts.admin.sections.extra',['config'=>config('templatable.page'),'instance'=>$page])
        @include('main::layouts.admin.sections.seo',['instance'=>$page])
    @endsection
    @section('aside')
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'featured_image', 'title'=>'featured_image', 'column'=>'featured_image','instance'=>$page])
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'banner', 'title'=>'banner', 'column'=>'banner','instance'=>$page])
        @include('main::layouts.admin.sections.template',['open'=>'true','path'=>'resources/views/pages/pages/templates', 'instance'=>$page])
        @include('main::layouts.admin.sections.tags',['open'=>'false','instance'=>$page])
        @include('main::layouts.admin.sections.publish-status',['open'=>'false','instance'=>$page])
    @endsection

</x-main::admin-editor-layout>
