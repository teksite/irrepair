<x-main::auth-layout>
    @section('title','login to the account')
    <div class="p-3">
        <div class="flex items-center justify-center gap-3 mb-3 mb-6">
            <i class="tkicon fill-none stroke-white block text-center" data-icon="user" size="50"></i>
            <h1 class="text-center text-white !mb-0">{{__('login to the account')}}</h1>
        </div>

        <form method="POST" action="{{ route('login') }}" class="formAction">
            @csrf
            <div class="mb-6">
                <div class="bg-white flex items-center border border-slate-200 rounded-lg mb-3">
                    <x-main::input.label for="username" title="{{__('email')}} / {{__('phone')}}"  value="<i class='tkicon fill-none stroke-gray-700' size='20' data-icon='user'></i>"
                                         class="flex flex-col justify-center items-center !mb-0 rounded  p-3"/>

                    <x-main::input.text type="text" id="username" :value="old('email')" name="email" title="{{__('username')}} / {{__('email')}}" class="block w-full"
                                        placeholder="{{__('enter your username')}}" required/>
                </div>
                <x-main::input.error :messages="$errors->get('email')" class="mt-2"/>
            </div>
            <div class="mb-6">
                <div class="bg-white flex items-center border border-slate-200 rounded-lg mb-3">
                    <x-main::input.label for="password" title="{{__('password')}}"  value="<i class='tkicon fill-none stroke-gray-700' size='20' data-icon='lock-closed'></i>"
                                         class="flex flex-col justify-center items-center !mb-0 rounded  p-3"/>
                    <x-main::input.text type="password" id="password" name="password" title="{{__('password')}}" required class="block w-full" placeholder="{{__('enter your password')}}"/>
                </div>
                <x-main::input.error :messages="$errors->get('password')" class="mt-2"/>

                @if (Route::has('password.request'))
                    <div class="flex justify-end">
                        <a href="{{route('password.request')}}" class="text-orange-300 text-xs mt-3 text-end  font-semibold">
                            {{__('do you forget your password?')}}
                        </a>
                    </div>
                @endif
            </div>
            <div class="mb-3 flex justify-start items-center gap-3">
                <x-main::input.checkbox id="remember" name="remember"/>
                <x-main::input.label for="remember" :value="__('remember me')" class="!mb-0 !text-base !text-white"/>
            </div>

            <div class="">
                <x-main::button.secondary class="block w-full">
                    {{__('sign in')}}
                </x-main::button.secondary>
            </div>
        </form>
        <div class="flex justify-between items-center gap-3 mt-3 px-3">
            <div>
                @if (Route::has('register'))
                    <a href="{{route('register')}}" class="text-red-600 underline underline-offset-2 font-bold">
                        {{__('i dont have an account')}}
                    </a>
                @endif
            </div>
            <div>
                <a href="/" class="text-gray-200 font-bold  hover:text-secondary-500 text-sm flex items-center gap-1">
                    <i class="tkicon fill-none stroke-current" size="20" data-icon="home"></i>
                    {{__('back to home')}}
                </a>
            </div>
        </div>
    </div>
</x-main::auth-layout>


