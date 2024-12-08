<x-main::admin-editor-layout :instance="$attribute" method="PATCH">
@section('title',__('edit :title',['title'=>__('attribute')]))
@section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('attribute'),'item'=>$attribute->title]))
@section('formRoute',route('admin.shop.attributes.update', $attribute))
@section('hero-start-section')
    <x-main::link.header :href="route('admin.shop.attributes.index')" :title="__('all :title',['title'=>__('attributes')])" />
    <x-main::link.header :href="route('admin.shop.attributes.values.index' ,$attribute)" :title="__('all :title',['title'=>__('values')])" />
@endsection
    @section('hero-end-section')
            <x-main::link.delete :route="route('admin.shop.attributes.destroy' , $attribute)" title="{{$attribute->title}}"/>
    @endsection

     @section('main')
     <x-main::box>
         <div class="my-3">
             <x-main::input.label for="title" value="{{__('title')}}"/>
             <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title') ?? $attribute->title"/>
             <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
         </div>
         @include('main::layouts.admin.sections.single-input',['open'=>'true', 'name'=>'icon', 'title'=>'icon', 'column'=>'icon','instance'=>$attribute ,'accordion'=>false])

     </x-main::box>

    @endsection
    @section('aside')
        @include('main::layouts.admin.sections.image',['open'=>'true', 'name'=>'featured_image', 'title'=>'featured_image', 'column'=>'featured_image','instance'=>$attribute])
    @endsection


</x-main::admin-editor-layout>

