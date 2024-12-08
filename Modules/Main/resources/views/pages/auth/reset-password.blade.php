<x-main::auth-layout>
    @section('title',__('reset password'))

    <section
        class="w-full min-h-screen flex flex-col justify-center items-center bg-back-1 bg-no-repeat bg-cover bg-center p-3">
        <div class="w-11/12 md:w-1/2">
            <div class="">
                <div class="flex flex-col gap-6 items-center justify-center p-3">
                    <div class="flex items-center gap-3">
                        <div>
                            <h1 class="!mb-0 text-white">
                                {{__(config('app.name'))}}
                            </h1>
                            <span class="text-white font-thin">
                                BARSA NOVIN RAY
                            </span>
                        </div>
                        <x-logo-project :title="__(config('app.name'))" class="w-16 bg-white p-1 rounded"/>
                    </div>
                </div>

                <div class="p-3 my-3">
                    <div class="flex items-center justify-center gap-3 mb-3">
                        <i class="tkicon  fill-none stroke-white block text-center" size="50" data-icon="password"></i>
                        <h2 class="text-center text-white !mb-0">
                            {{__('reset password form')}}
                        </h2>

                    </div>

                    <form method="POST" action="{{ route('password.update') }}" class="formAction">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="mb-3">
                            <x-input.label class="text-white" for="email" :value="__('email')"/>
                            <x-input.text id="email" readonly class="block w-full" type="email" name="email"
                                          :value="old('email', $request->email)" required autofocus
                                          autocomplete="username"/>
                            <x-input.error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <x-input.label class="text-white" for="password" :value="__('new password')"/>
                            <x-input.text id="password" class="block w-full" type="password" name="password" required
                                          autocomplete="new-password"/>
                            <x-input.error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <x-input.label class="text-white" for="password_confirmation"
                                           :value="__('confirm new Password')"/>
                            <x-input.text id="password_confirmation" class="block w-full" type="password"
                                          name="password_confirmation"
                                          required autocomplete="new-password"/>

                            <x-input.error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                        </div>

                        <div class="flex items-center justify-end mb-3">

                            <x-button-primary class="capitalize">
                                {{ __('reset password') }}
                            </x-button-primary>
                        </div>
                    </form>

                </div>
                <div>
                    <hr class="my-1">
                    <div class="flex justify-between items-center flex-wrap gap-6">
                        <a href="/"
                           class="text-gray-200 hover:text-secondary-500 text-sm flex items-center gap-1">
                            <i class="tkicon stroke-current fill-none" size="20" data-icon="home"></i>
                            {{__('back to home')}}
                        </a>
                        @include('layouts.auth.partials.contact-ways')

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main::auth-layout>


