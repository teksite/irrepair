<x-main::panel-editor-layout>
    @section('title',__('change password'))
    @section('hero-start')
        <h2>
            {{__('password')}}
        </h2>
    @endsection
    @section('hero-end')
        @include('main::layouts.panel.partials.user-menu')
    @endsection

    @section('main')

        <form method="POST" action="{{route('panel.users.password.update')}}">
            @csrf  @method('PATCH')
            <x-main::box class="mb-6">
                <div class="mb-3">
                    <x-main::input.label for="current_password" value="{{__('current password')}}"/>
                    <x-main::input.text id="current_password" name="current_password" type="password"
                                        class="block w-full" autocomplete="current-password"  placeholder="{{__('current password')}}"/>
                    <x-main::input.error :messages="$errors->get('current_password')" class="mt-2"/>
                </div>

                <div class="mb-3">
                    <x-main::input.label for="password" value="{{__('new password')}}"/>
                    <x-main::input.text id="password" name="password" type="password" class=" block w-full"
                                        placeholder="{{__('new password')}}" autocomplete="new-password"
                    />
                    <x-main::input.error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <div class="mb-3">
                    <x-main::input.label for="password_confirmation" value="{{__('repeat new password')}}"/>
                    <x-main::input.text id="password_confirmation" name="password_confirmation" type="password"
                                        placeholder="{{__('repeat new password')}}" class="block w-full"
                                        autocomplete="new-password"/>
                    <x-main::input.error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>

                <div class="flex items-center justify-end">
                    <x-main::button.primary>
                        {{__('update')}}
                    </x-main::button.primary>
                </div>
            </x-main::box>

        </form>
    @endsection

</x-main::panel-editor-layout>




