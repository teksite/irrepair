<x-main::admin-editor-layout :instance="$tag" method="PATCH">
@section('title',__('edit :title',['title'=>__('tag')]))
@section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('tag'),'item'=>$tag->title]))
@section('formRoute',route('admin.tags.update', $tag))
@section('hero-start-section')
    <x-main::link.header :href="route('admin.tags.index')" :title="__('all :title',['title'=>__('tags')])" />
@endsection
    @section('hero-end-section')
            <x-main::link.delete :route="route('admin.tags.destroy' , $tag)" title="{{$tag->title}}"/>
    @endsection

     @section('main')
     <x-main::box>
         <div class="my-3">
             <x-main::input.label for="title" value="{{__('title')}}"/>
             <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title') ?? $tag->title"/>
             <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
         </div>
     </x-main::box>

    @endsection


</x-main::admin-editor-layout>

