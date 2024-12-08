<section class="w-3/4">
    <h3 class="text-white">
        {{__('using on time code')}}
    </h3>
    <p class="text-sm text-gray-200 mb-6">
        {{ __('enter your the code has been sent you to login')}}.
    </p>
    <form method="POST" action="{{route('auth.otp.login')}}" class="formAction">
        @csrf
        <input type="hidden" name="usage" value="login">
        <input type="hidden" name="type" value="web">

        <div class="mb-3">
            <div class="flex items-center border border-slate-200 rounded">
                <input type="text" id="sent_code" name="sent_code" title="{{__('sent code')}}"
                       class="block w-full bg-transparent px-3 py-2 focus:outline-none text-white"
                       placeholder="{{__('enter the sent code')}}"/>
                <x-input.label for="sent_code" :value="__('code')" class="flex flex-col justify-center items-center !mb-0 p-3 text-white border-e border-slate-200"/>
            </div>
            <x-input.error :messages="$errors->get('sent_code')" class="mt-2"/>
        </div>

        <div class="">
            <x-button.primary class="block w-full" type="submit" rol="button" title="{{ __('confirm') }}">
                {{ __('confirm') }}
            </x-button.primary>
        </div>

    </form>
    <hr class="my-3">
    <form action="{{route('auth.otp.send')}}" method="POST" id="form2Factor">
        <input type="hidden" name="usage" value="login">
        <input type="hidden" name="type" value="web">
        @csrf
        <input type="hidden" value="login-web">
        <div class="mb-3 flex items-center gap-6">
            <x-input.label class="!mb-0 text-white font-bold" :value="__('send code via')"/>
            <span class="text-white font-bold">:</span>
            <div class="flex gap-3 items-center">
                @php($user=\App\Models\User::find(session()->get('login')['id']))
                @if($user->email)
                    <button id="sendCodeViaEmail" class="send2Factor text-gray-200" type="submit"
                            title="{{__('send code via email')}}" value="email" name="via">
                        {{__('email')}}
                    </button>
                @endif
                @if($user->telegram_id)
                    <button id="sendCodeViaTelegram" class="send2Factor text-gray-200" type="submit"
                            title="{{__('send code via telegram')}}" value="telegram" name="via">
                        {{__('telegram')}}
                    </button>
                @endif

                @if($user->phone)
                    <button id="sendCodeViaSMS" class="send2Factor text-gray-200" type="submit"
                            title="{{__('send code via sms')}}" value="sms" name="via">
                        {{__('sms')}}
                    </button>
                @endif


            </div>

        </div>
    </form>
    <div>
        <span id="waitEl"></span>
    </div>
</section>
