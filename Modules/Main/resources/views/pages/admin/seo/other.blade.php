<x-main::admin-layout  method="PATCH">
    @section('title' , __('edit seo of pages'))
    @section('header-description',__('in this window you can see change details of seo'))
    @section('formRoute',route('admin.seo.others.blog.update'))

        {!! Module::getMenu('admin','other-seo-page') !!}

</x-main::admin-layout>
