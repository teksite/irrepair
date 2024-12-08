<x-main::auth-layout>
    @section('title',__('registration'))

    <div class="p-3">
        <div class="flex items-center justify-center gap-3 mb-6">
            <i class="tkicon fill-none stroke-white block text-center" size="50" data-icon="users"></i>
            <h1 class="text-center !text-white !mb-0">{{__('registration')}}</h1>
        </div>
        <form method="POST" action="{{ route('register') }}" class="formAction">
            @csrf
            <div>
                <div class="grid gap-3 lg:grid-cols-2">
                    <div class="mb-3">
                        <x-main::input.label class="!text-gray-200" for="name" value="{{__('full name')}}/{{__('company name')}}"/>
                        <x-main::input.text id="name" class="block w-full" type="text" name="name" :value="old('name')"  required="required"/>
                        <x-main::input.error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <x-main::input.label class="!text-gray-200" for="username" value="{{__('username')}}"/>
                        <x-main::input.text id="name" class="block w-full" type="text" name="username" :value="old('username')" required="required"/>
                        <x-main::input.error :messages="$errors->get('username')" class="mt-2"/>
                    </div>

                </div>
                <div class="">

                    <div class="mb-3">
                        <x-main::input.label class="!text-gray-200" for="email" value="{{__('email')}}"/>
                        <x-main::input.text id="email" class="block w-full" type="email" name="email" :value="old('email')" required/>
                        <x-main::input.error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <div class="mb-3">
                        <x-main::input.label class="!text-gray-200" for="phone" value="{{__('phone')}}"/>
                        <x-main::input.text id="phone" class="block w-full" type="tel" name="phone" :value="old('phone')" required/>
                        <x-main::input.error :messages="$errors->get('phone')" class="mt-2"/>
                    </div>
                </div>
                <div class="grid gap-3 lg:grid-cols-2">

                    <div class="mb-3">
                        <x-main::input.label class="!text-gray-200" for="password" value="{{__('password')}}"/>
                        <x-main::input.text id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-main::input.error :messages="$errors->get('password')" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <x-main::input.label class="!text-gray-200" for="password_confirmation" value="{{__('password conformation')}}"/>
                        <x-main::input.text id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required  />
                        <x-main::input.error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                    </div>
                </div>

                <div class="mb-3 w-full text-left">
                    <x-main::button.primary class="w-full block">
                        {{__('register')}}
                    </x-main::button.primary>
                </div>
            </div>
        </form>
        <div class="flex justify-between items-center gap-3 mt-3 px-3">
            @if (Route::has('login'))
                <div>
                    <a href="{{route('login')}}" class="text-red-600 underline underline-offset-2 font-bold">
                        {{__('i have an account')}}
                    </a>
                </div>
            @endif
            <div>
                <a href="/"
                   class="text-gray-200 hover:text-secondary-500 text-sm flex items-center gap-1">
                    <i class="tkicon stroke-current fill-none" size="20" data-icon="home"></i>
                    {{__('back to home')}}
                </a>
            </div>
        </div>
    </div>
</x-main::auth-layout>
