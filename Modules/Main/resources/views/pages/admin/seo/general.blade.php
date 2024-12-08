<x-main::admin-editor-layout  method="PATCH">
    @section('header-description',__('in this window you can see change details of seo'))
    @section('formRoute',route('admin.seo.general.update'))
    @section('hero-start-section')
        <x-main::link.header :title="__('general')" href="{{route('admin.seo.general.edit')}}?type=seo_general"/>
        <x-main::link.header :title="__('local business')" href="{{route('admin.seo.general.edit')}}?type=seo_localBusiness"/>
        <x-main::link.header :title="__('organization')" href="{{route('admin.seo.general.edit')}}?type=seo_organization"/>
    @endsection
    @section('main')

        @includeWhen(request()->get('type') == 'seo_general', 'main::pages.admin.seo.types.general')
        @includeWhen(request()->get('type') == 'seo_organization', 'main::pages.admin.seo.types.organization')
        @includeWhen(request()->get('type') == 'seo_localBusiness', 'main::pages.admin.seo.types.local')

    @endsection

</x-main::admin-editor-layout>
