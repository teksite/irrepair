<x-main::panel-editor-layout>
@section('title',__('two factor authentication'))
    @section('hero-start')
        <h2>
            {{__('two factor authentication')}}
        </h2>
    @endsection
    @section('hero-end')
        @include('main::layouts.panel.partials.user-menu')
    @endsection

    @section('main')

        @if(auth()->user()->two_factor_secret)
            <div class="grid gap-6 lg:grid-cols-2 mb-6">
                <x-main::box>
                    <h3>
                        {{__('two factor recovery codes')}}
                    </h3>
                    <p>
                        {{__('keep below data in a secure place and DO NOT SHARE IT with no one')}}.
                    </p>
                    <ul class="space-y-3 mt-3">
                        @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes , true)) as $code)
                            <li class="font-bold">{{trim($code)}}</li>
                        @endforeach
                    </ul>
                </x-main::box>
                <x-main::box class="flex items-center">
                    <div class="grid gap-6 md:grid-cols-2 items-center">
                        <div>
                            <h3 class="">
                                {{__('QR code')}}
                            </h3>
                            <p class="p mb-3">
                                {{__('to use qr code you should download Google Authenticator app on your phone and then scan below code')}}   </p>
                            <a class="regular flex gap-3 mb-3"
                               href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en&gl=US">
                                <img src="{{asset('/admin/images/google-play.svg')}}" alt="{{__('google play')}}" width="25" height="25"> {{__('download')}}
                            </a>

                        </div>
                        <div class="flex items-center justify-center">
                            {!! request()->user()->twoFactorQrCodeSvg(); !!}

                        </div>
                    </div>
                </x-main::box>
            </div>
            <x-main::box class="mb-6">
                <div>
                    <div class="my-3">
                        <x-main::input.label for="phone" value="{{__('phone')}}"/>
                        <x-main::input.text id="phone" class="block mt-1 w-full" :disabled="true" type="text" :value="$user->phone"/>
                    </div>
                    <div class="my-3">
                        <x-main::input.label for="email" value="{{__('email')}}"/>
                        <x-main::input.text id="email" class="block mt-1 w-full" :disabled="true" type="text" value="{{$user->email}}"/>
                    </div>
                </div>
            </x-main::box>
            <x-main::box class="mb-6">
                <form method="POST" action="{{route('two-factor.disable')}}">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3  flex flex-col md:flex-row items-center justify-between gap-6">
                        <p class="mb-0 w-full">
                            {{__('the Two Factor Authentication is enabled, to disable it please click on the "disable" button')}}
                        </p>
                        <x-main::button.primary class="w-64">
                            {{ __('disable') }}
                        </x-main::button.primary>
                    </div>
                </form>
            </x-main::box>
        @else
            <x-main::box>
                <form method="POST" action="{{ url('user/two-factor-authentication')}}">
                    @csrf
                    <div class="mb-3  flex flex-col md:flex-row items-center justify-between gap-6">
                        <p class="mb-0 w-full">
                            {{__('the Two Factor Authentication is disabled, to enable it please click on the "enable" button')}}
                        </p>
                        <x-main::button.primary class="w-64">
                            {{ __('enable') }}
                        </x-main::button.primary>
                    </div>

                </form>
            </x-main::box>
        @endif
    @endsection

</x-main::panel-editor-layout>




