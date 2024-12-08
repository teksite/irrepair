<x-main::admin-editor-layout :instance="$product" method="PATCH">
    @section('title',__('edit :title',['title'=>__('product')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('product'),'item'=>$product->title]))
    @section('formRoute',route('admin.shop.products.update', $product))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.shop.products.index')" :title="__('all :title',['title'=>__('products')])" />
        @can('product-create')
            <x-main::link.header :href="route('admin.shop.products.create')" :title="__('new :title',['title'=>__('product')])" />
        @endcan
    @endsection
    @section('hero-end-section')
        @can('product-delete')
            <x-main::link.delete :route="route('admin.shop.products.destroy' , $product)" title="{{$product->title}}"/>
        @endcan
    @endsection

    @section('top')
        @include('main::layouts.admin.sections.title',['instance'=>$product])
        @include('main::layouts.admin.sections.slug',['instance'=>$product])
    @endsection
    @section('main')
        @include('main::layouts.admin.sections.text',['name'=>'excerpt' ,'column'=>'excerpt' ,'title'=>__('excerpt'),'instance'=>$product])
        @include('main::layouts.admin.sections.text-editor',['name'=>'introduction' ,'column'=>'introduction' ,'title'=>__('introduction'),'instance'=>$product])
        @include('main::layouts.admin.sections.text-editor',['name'=>'body' ,'column'=>'body' ,'title'=>__('body'),'instance'=>$product])
        @include('shop::layouts.admin.sections.chapters',['open'=>'false','instance'=>$product])
        @include('shop::layouts.admin.sections.attributes' ,['instance'=>$product])

        @include('shop::layouts.admin.sections.prices',['open'=>'false','instance'=>$product])
        @include('main::layouts.admin.sections.faq',['open'=>'false','instance'=>$product])
        @include('main::layouts.admin.sections.seo',['instance'=>$product])
    @endsection
    @section('aside')
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'featured_image', 'title'=>'featured_image', 'column'=>'featured_image','instance'=>$product])
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'image', 'title'=>'image', 'column'=>'image','instance'=>$product])
        @include('main::layouts.admin.sections.video',['open'=>'true', 'name'=>'video', 'title'=>'video', 'column'=>'video','preview'=>true,'instance'=>$product])
        @include('shop::layouts.admin.sections.categories',['open'=>'true','instance'=>$product])
        @include('main::layouts.admin.sections.order',['open'=>'true','instance'=>$product])
        @include('main::layouts.admin.sections.template',['open'=>'true','path'=>'resources/views/pages/shop/products/templates','instance'=>$product])
        @include('main::layouts.admin.sections.tags',['open'=>'false','instance'=>$product])
        @include('main::layouts.admin.sections.publish-status',['open'=>'false','instance'=>$product])
    @endsection

</x-main::admin-editor-layout>

