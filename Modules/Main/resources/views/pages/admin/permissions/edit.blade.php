<x-main::admin-editor-layout :instance="$permission" method="PATCH">
@section('title',__('edit :title',['title'=>__('permission')]))
@section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('permission'),'item'=>$permission->title]))
@section('formRoute',route('admin.permissions.update', $permission))
@section('hero-start-section')
    <x-main::link.header :href="route('admin.permissions.index')" :title="__('all :title',['title'=>__('permissions')])" />
@endsection
    @section('hero-end-section')
        @can('permission-delete')
            <x-main::link.delete :route="route('admin.permissions.destroy' , $permission)" title="{{$permission->title}}"/>
        @endcan
    @endsection

     @section('main')
     <x-main::box>
         <div class="my-3">
             <x-main::input.label for="title" value="{{__('title')}}"/>
             <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title') ?? $permission->title"/>
             <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
         </div>

         <div class="my-3">
             <x-main::input.label for="description" value="{{__('description')}}"/>
             <x-main::input.text id="description" class="block mt-1 w-full" type="text" name="description"  :value="old('description') ?? $permission->description"/>
             <x-main::input.error :messages="$errors->get('description')" class="mt-2"/>
         </div>
     </x-main::box>

    @endsection


</x-main::admin-editor-layout>

