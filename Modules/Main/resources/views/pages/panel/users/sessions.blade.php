<x-main::panel-editor-layout>
@section('title',__('control sessions'))
    @section('hero-start')
        <h2>
            {{__('sessions')}}
        </h2>
    @endsection
    @section('hero-end')
        @include('main::layouts.panel.partials.user-menu')
    @endsection

    @section('main')

        <x-main::box class="mb-6 grid gap-6 md:grid-cols-2">
            <div>
                {{__('flush all sessions')}}
            </div>
            <div class="flex items-center justify-end">
                <x-main::button.danger type="button" role="button"
                                       x-data="" x-on:click.prevent="$dispatch('open-modal', 'open-flush-sessions')">
                    {{__('flush all')}}
                </x-main::button.danger>

                <x-main::modal name="open-flush-sessions">
                    <div class="p-3">
                        <h2 class="text-center">
                            {{__('request for flushing all sessions from all devices')}}
                        </h2>
                        <p class="text-center text-xs">
                            {{__('to logout device/s you should insert your account password to verify you')}}
                        </p>
                        <form class="my-6" id="flush-logout" action="{{route('panel.users.sessions.destroy')}}"
                              method="POST">
                            @csrf @method('DELETE')

                            <div class="flex items-center gap-6">
                                <x-main::input.label for="password" :value="__('password')" class="mb-0 min-w-fit"/>
                                <x-main::input.text type="password" name="password" id="password" class="block w-full"/>
                            </div>

                        </form>
                        <div class="flex items-center justify-between">
                            <button type="button" role="button" @click="show=false" class="font-bold text-blue-600 hover:text-blue-800">
                                {{__('cancel')}}
                            </button>
                            <x-main::button.danger type="submit" role="submit"
                                                   onclick="document.getElementById('flush-logout').submit()">
                                {{__('submit')}}
                            </x-main::button.danger>
                        </div>
                    </div>

                </x-main::modal>
            </div>
        </x-main::box>
    @endsection

</x-main::panel-editor-layout>




