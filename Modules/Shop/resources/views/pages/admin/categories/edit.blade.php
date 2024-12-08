<x-main::admin-editor-layout :instance="$category" method="PATCH">
@section('title',__('edit :title',['title'=>__('category')]))
@section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('category'),'item'=>$category->title]))
@section('formRoute',route('admin.shop.categories.update', $category))
@section('hero-start-section')
    <x-main::link.header :href="route('admin.shop.categories.index')" :title="__('all :title',['title'=>__('categories')])" />
@endsection
    @section('hero-end-section')
            <x-main::link.delete :route="route('admin.shop.categories.destroy' , $category)" title="{{$category->title}}"/>
    @endsection

     @section('main')
     <x-main::box>
         <div class="my-3">
             <x-main::input.label for="title" value="{{__('title')}}"/>
             <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title') ?? $category->title"/>
             <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
         </div>
     </x-main::box>

    @endsection


</x-main::admin-editor-layout>

