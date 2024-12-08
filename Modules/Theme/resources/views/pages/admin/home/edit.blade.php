<x-main::admin-editor-layout method="PATCH">
@section('title' , __('edit :title',['title'=>__('homepage')]))))
    @section('header-description' , __("in this window you can edit the :title", ['title'=>__('homepage')]))

    @section('formRoute',route('admin.appearance.theme.update'))

   @section('main')
        @include('theme::layouts.admin.sections.home.banner' ,['banners'=>$items['homepage_banners']])
        @include("theme::layouts.admin.sections.extra.content",['open'=>"false",'label'=>'introduction','key'=>'introduction','data'=>$items['homepage_introduction']['value'] ?? []])

        @include("theme::layouts.admin.sections.extra.dynamic-content",['open'=>"false",'label'=>'features','key'=>'features','data'=>$items['homepage_features']['value']?? []])
        @include("theme::layouts.admin.sections.extra.dynamic-content",['open'=>"false",'label'=>'solutions','key'=>'solutions','data'=>$items['homepage_solutions']['value']?? []])
        @include("theme::layouts.admin.sections.extra.content",['open'=>"false",'label'=>'about','key'=>'about','data'=>$items['homepage_about']['value']?? []])
        @include("theme::layouts.admin.sections.extra.get-models",['open'=>"false" ,'model'=>\Modules\Customer\Models\Customer::class,'multiple'=>true,'key'=>'customers','label'=>'customers' ,'dataLabel'=>'title' ,'dataValue'=>'id' ,'dataSearch'=>'title' ,'url'=>route('admin.ajax.customers.get'),'selected'=>$items['homepage_customers']['value'] ?? []])

    @endsection

    @section('aside')

    @endsection

</x-main::admin-editor-layout>
