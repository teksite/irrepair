<x-main::admin-editor-layout>
    @section('title' , __('new :title',['title'=>__('product')]))
    @section('formRoute',route('admin.shop.products.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('product')]))
    @section('hero-start-section')
        <x-main::link.header :title="__('all :title',['title' =>__('products')])" :href="route('admin.shop.products.index')"/>
    @endsection
    @section('hero-end-section')
    @endsection
    @section('top')
        @include('main::layouts.admin.sections.title')
        @include('main::layouts.admin.sections.slug')
    @endsection
    @section('main')
        @include('main::layouts.admin.sections.text',['name'=>'excerpt' ,'column'=>'excerpt' ,'title'=>__('excerpt')])
        @include('main::layouts.admin.sections.text-editor',['name'=>'introduction' ,'column'=>'introduction' ,'title'=>__('introduction')])
        @include('main::layouts.admin.sections.text-editor',['name'=>'body' ,'column'=>'body' ,'title'=>__('body')])
        @include('shop::layouts.admin.sections.prices')
        @include('shop::layouts.admin.sections.chapters')
        @include('shop::layouts.admin.sections.attributes')
        @include('main::layouts.admin.sections.faq')
        @include('main::layouts.admin.sections.seo')
    @endsection
    @section('aside')
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'featured_image', 'title'=>'featured_image', 'column'=>'featured_image'])
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'image', 'title'=>'image', 'column'=>'image'])
        @include('main::layouts.admin.sections.video',['open'=>'true', 'name'=>'video', 'title'=>'video', 'column'=>'video','preview'=>true])
        @include('shop::layouts.admin.sections.categories',['open'=>'true',])
        @include('main::layouts.admin.sections.order',['open'=>'true', 'default'=>\Modules\Shop\Models\Product::query()->max('order') + 1])
        @include('main::layouts.admin.sections.template',['open'=>'true','path'=>'resources/views/pages/shop/products/templates'])
        @include('main::layouts.admin.sections.tags',['open'=>'false'])
        @include('main::layouts.admin.sections.publish-status',['open'=>'false'])
    @endsection

</x-main::admin-editor-layout>
