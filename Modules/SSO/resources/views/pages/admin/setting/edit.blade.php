<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('sso')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('sso')]))

    @section('hero-start-section')

    @endsection
    @section('hero-end-section')
    @endsection

    @section('main')
        <div class="grid gap-6 md:grid-cols-2">
            <form method="POST" class="{{route('admin.settings.sso.update')}}">
                @csrf @method('PATCH')

                @foreach(\Modules\SSO\Enums\SsoTypeEnum::cases() as $type)
                    <x-main::box class="mb-6">
                        <h2 class="mb-6">
                            {{__($type->value)}}
                        </h2>
                        <div>
                            <input hidden name="type" value="{{$type->value}}">
                            <div class="mb-3">
                                <div class="flex gap-6 items-center justify-start">
                                    <div class="flex justify-start gap-1 items-start">
                                        <x-main::input.label for="{{$type->value}}_disabled"
                                                             value="{{__('deactivate')}}"/>
                                        <x-main::input.radio id="{{$type->value}}_disabled"
                                                             class="block mt-1 accent-green-800"
                                                             name="social[{{$type->value}}][stance]"
                                                             value="off"
                                                             :checked="!isset($data[$type->value]['stance']) || $data[$type->value]['stance'] ==='off' "/>
                                    </div>
                                    <div class="flex justify-start gap-1 items-start">
                                        <x-main::input.label for="{{$type->value}}_enable" value="{{__('activate')}}"/>
                                        <x-main::input.radio id="{{$type->value}}_enable"
                                                             class="block mt-1 accent-green-800"
                                                             name="social[{{$type->value}}][stance]"
                                                             value="on"
                                                             :checked="isset($data[$type->value]['stance']) && $data[$type->value]['stance'] ==='on' "/>
                                    </div>

                                </div>
                                <x-main::input.error :messages="$errors->get('social.'.$type->value.'.stance')"
                                                     class="mt-2"/>

                            </div>
                            <div class="mb-3">
                                <x-main::input.label for="{{$type->value}}_client_id" value="client id"/>
                                <x-main::input.text id="{{$type->value}}_client_id" class="block mt-1 w-full"
                                                    type="text" dir="ltr" name="social[{{$type->value}}][client_id]"
                                                    :readonly="true"
                                                    :value="old('social.'.$type->value.'.client_id') ?? env(Str::upper($type->value).'_CLIENT_ID') ?? $data[$type->value]['value']['client_id'] ?? ''"/>
                                <x-main::input.error :messages="$errors->get('social'.$type->value.'client_id') "
                                                     class="mt-2"/>
                            </div>
                            <div class="mb-3">
                                <x-main::input.label for="client_secret_key" value="client secret key"/>
                                <x-main::input.text id="client_secret_key" class="block mt-1 w-full" type="text"
                                                    dir="ltr"
                                                    name="social[{{$type->value}}][client_secret_key]" :readonly="true"
                                                    :value="old('social.'.$type->value.'.client_secret_key') ?? env(Str::upper($type->value).'_CLIENT_SECRET_KEY') ?? $data[$type->value]['value']['client_secret_key'] ?? ''"/>
                                <x-main::input.error :messages="$errors->get('social'.$type->value.'client_secret_key')"
                                                     class="mt-2"/>
                            </div>
                            <div class="mb-3">
                                <x-main::input.label for="{{$type->value}}_callback_url" value="callback URL"/>
                                <x-main::input.text id="{{$type->value}}_callback_url" class="block mt-1 w-full"
                                                    type="text" dir="ltr" :readonly="true" :disabled="true"
                                                    :value="route('auth.sso.callback',['type'=>$type->value])"/>
                                @if(env(Str::upper($type->value).'_CALLBACK_URL') && route('auth.sso.callback',['type'=>$type->value]) !== env(Str::upper($type->value).'_CALLBACK_URL'))
                                    <div class="mt-3">
                                        <p class="text-red-700">
                                            {{__('the callback url in env file is not set correctly')}}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </x-main::box>
                @endforeach

                <div class="mb-3 flex justify-end items-center">
                    <x-main::button.primary>
                        {{__('update')}}
                    </x-main::button.primary>
                </div>
            </form>
            <main::x-box>
                <p>
                    {{__('use the below links to create permission use the authentication ways and get client id and secret key id')}}
                    .
                </p>
                <div class="flex items-center gap-6 flex-wrap">
                    <a href="https://console.cloud.google.com/apis/credentials">Google</a>
                    <a href="https://console.cloud.google.com/apis/credentials">Google</a>
                    <a href="https://console.cloud.google.com/apis/credentials">Google</a>
                    <a href="https://console.cloud.google.com/apis/credentials">Google</a>
                    <a href="https://console.cloud.google.com/apis/credentials">Google</a>
                </div>
                <hr class="my-6">
                <p>
                    {{__('to use social authentication module, use the below component in your sign up or sign in page')}}
                    .
                </p>
                <div dir="ltr" class="my-6">
                    <span> <</span>sso::social / <span>> </span>
                </div>
                <p>
                    * {{__('if the user was registered before, he/shw would sign in to the account else a new account would be created')}}
                    .
                </p>
            </main::x-box>
        </div>
    @endsection

</x-main::admin-list-layout>

