<x-main::auth-layout>
    @section('title','request resetting password')

    <div class="p-3">
        <x-main::box class="">
            <h2 class="text-center">{{__('reset password form')}}</h2>
            <hr class="my-3 mx-auto w-3/4">
            <p>
                {{ __('to reset your password, fill the below field. we will be sent you an reset password link') }}
            </p>
            <form method="POST" action="{{ route('password.request') }}" class="formAction">
                @csrf
                <div class="mb-3">
                    <x-main::input.label for="email" :value="__('email')"/>
                    <x-main::input.text id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required autofocus
                                        placeholder="{{__('write your email registered when you signed up')}}"/>
                    <x-main::input.error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <div class="flex items-center justify-between">
                    <x-main::button.primary class="capitalize">
                        {{ __('email password reset link') }}
                    </x-main::button.primary>
                </div>
            </form>
        </x-main::box>
        <div class="flex justify-between items-center gap-3 mt-3 px-3">
            @if (Route::has('login'))
                <div class="w-full">
                    <a href="{{ route('login') }}"
                       class="text-red-600 font-bold underline underline-offset-2">
                        {{ __('back') }}
                    </a>
                </div>
            @endif
                <div class="w-full flex justify-end">
                    <x-back-home />
                </div>
        </div>
    </div>
</x-main::auth-layout>
