<x-main::admin-editor-layout :instance="$category" method="PATCH">
    @section('title',__('edit :title',['title'=>__('category')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('category'),'item'=>$category->title]))
    @section('formRoute',route('admin.blog.categories.update', $category))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.blog.categories.index')" :title="__('all :title',['title'=>__('categories')])" />
        @can('category-create')
            <x-main::link.header :href="route('admin.blog.categories.create')" :title="__('new :title',['title'=>__('category')])" />
        @endcan
    @endsection
    @section('hero-end-section')
        @can('post-category-delete')
            <x-main::link.delete :route="route('admin.blog.categories.destroy' , $category)" title="{{$category->title}}"/>
        @endcan
    @endsection

    @section('top')
        @include('main::layouts.admin.sections.title',['instance'=>$category])
        @include('main::layouts.admin.sections.slug',['instance'=>$category])
    @endsection

    @section('main')
        @include('blog::layouts.admin.sections.categories-creation' ,['open'=>'true' ,'title'=>'parent' ,'instance'=>$category])
        @include('main::layouts.admin.sections.text-editor' ,['open'=>'false' ,'instance'=>$category ])
    @endsection


    @section('aside')
        @include('main::layouts.admin.sections.image' ,['open'=>'true' , 'column'=>'featured_image','title'=>'featured image','instance'=>$category])
    @endsection


    @section('aside')

    @endsection

</x-main::admin-editor-layout>
