<x-main::admin-editor-layout :instance="$user" method="PATCH">
    @section('title',__('edit :title',['title'=>__('user')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('user'),'item'=>$user->name]))
    @section('formRoute',route('admin.users.update', $user))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.users.index')" :title="__('all :title',['title'=>__('users')])" />
        @can('user-create')
            <x-main::link.header :href="route('admin.users.create')" :title="__('new :title',['title'=>__('user')])" />
        @endcan
    @endsection
    @section('hero-end-section')
        @can('user-delete')
            <x-main::link.delete :route="route('admin.users.destroy' , $user)" title="{{$user->name}}"/>
        @endcan
    @endsection

    @section('main')

        <section class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
            <x-main::box class="xl:col-span-2">
                <div class="my-3">
                    <x-main::input.label for="name" value="{{__('full name')}}/{{__('company name')}}"/>
                    <x-main::input.text id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name') ?? $user->name"/>
                    <x-main::input.error :messages="$errors->get('name')" class="mt-2"/>
                </div>
                <div class="my-3">
                    <x-main::input.label for="nickname" value="{{__('nickname')}}"/>
                    <x-main::input.text id="nickname" class="block mt-1 w-full" type="text" name="nickname" :value="old('nickname') ?? $user->nickname"/>
                    <x-main::input.error :messages="$errors->get('nickname')" class="mt-2"/>
                </div>
                <div class="my-3">
                    <x-main::input.label for="email" value="{{__('email')}}"/>
                    <x-main::input.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email') ?? $user->email"/>
                    <x-main::input.error :messages="$errors->get('email')" class="mt-2"/>
                </div>
                <div class="my-3">
                    <x-main::input.label for="phone" value="{{__('phone')}}"/>
                    <x-main::input.text id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone') ?? $user->phone"/>
                    <x-main::input.error :messages="$errors->get('phone')" class="mt-2"/>
                </div>
                <div class="my-3">
                    <x-main::input.label for="password" value="{{__('password')}}"/>
                    <x-main::input.text id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" placeholder="{{__('leave it empty to not change')}}"/>
                    <x-main::input.error :messages="$errors->get('password')" class="mt-2"/>
                </div>
                <div class="my-3">
                    <x-main::input.label for="username" value="{{__('username')}}"/>
                    <x-main::input.text id="username" class="block mt-1 w-full" type="text" :value="$user->username" :readonly="true" :disabled="true"/>
                </div>
            </x-main::box>

            <div class="">
                @include('main::layouts.admin.sections.image' ,['open'=>'true' ,'name'=>'featured_image', 'column'=>'featured_image','title'=>'avatar','instance'=>$user ,'placeholder'=>'profile'])
            </div>

            <x-main::box class="md:col-span-2 xl:col-span-3">
                @include('main::layouts.admin.sections.user_extra_info' ,['instance'=>$user->getMeta('social')])
            </x-main::box>
        </section>
    @endsection
    @section('aside')
        <x-main::box>
            <x-main::input.label for="maxUserCreation" value="{{__('max number of creating :item' ,['title'=>__('user')])}}"/>
            <x-main::input.text min="-1" type="number" id="maxUserCreation" name="meta[max_user_creation][value]" class="block w-full" :value="old('meta.max_user_creation.value') ?? $creation['value']['value'] ?? 0"/>
            <x-main::input.error :messages="$errors->get('meta.max_user_creation')" class="mt-2"/>
        </x-main::box>
        @include('main::layouts.admin.sections.roles', ['multiple'=>false ,'open'=>'false' ,'instance'=>$user])
        @include('main::layouts.admin.sections.permissions', ['multiple'=>true ,'open'=>'false' ,'instance'=>$user])
    @endsection

</x-main::admin-editor-layout>

