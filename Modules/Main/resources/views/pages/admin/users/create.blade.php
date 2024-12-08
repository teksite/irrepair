<x-main::admin-editor-layout>
    @section('title' , __('new :title',['title'=>__('user')]))
    @section('formRoute',route('admin.users.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('user')]))


    @section('hero-start-section')
        <x-main::link.header :title="__('all :title',['title' =>__('users')])" :href="route('admin.users.index')"/>
    @endsection

    @section('main')
        <x-main::box >
            <div class="my-3">
                <x-main::input.label for="name" value="{{__('name')}}"/>
                <x-main::input.text id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"/>
                <x-main::input.error :messages="$errors->get('name')" class="mt-2"/>
            </div>

            <div class="my-3">
                <x-main::input.label for="username" value="{{__('username')}}"/>
                <x-main::input.text id="username" class="block mt-1 w-full" type="tel" name="username" :value="old('username')"/>
                <x-main::input.error :messages="$errors->get('username')" class="mt-2"/>
            </div>

            <div class="my-3">
                <x-main::input.label for="email" value="{{__('email')}}"/>
                <x-main::input.text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"/>
                <x-main::input.error :messages="$errors->get('email')" class="mt-2"/>
            </div>
            <div class="my-3">
                <x-main::input.label for="phone" value="{{__('phone')}}"/>
                <x-main::input.text id="phone" class="block mt-1 w-full" type="phone" name="phone" :value="old('phone')"/>
                <x-main::input.error :messages="$errors->get('phone')" class="mt-2"/>
            </div>
            <div class="my-3">
                <x-main::input.label for="password" value="{{__('password')}}"/>
                <x-main::input.text id="password" class="block mt-1 w-full"  type="password" name="password"/>
                <x-main::input.error :messages="$errors->get('password')" class="mt-2"/>
            </div>
            <div class="my-3">
                <x-main::input.label for="password_confirmation" value="{{__('password conformation')}}"/>
                <x-main::input.text id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"/>
                <x-main::input.error :messages="$errors->get('password_confirmation')" class="mt-2"/>
            </div>
        </x-main::box>
    @endsection


    @section('aside')


    @endsection

</x-main::admin-editor-layout>
