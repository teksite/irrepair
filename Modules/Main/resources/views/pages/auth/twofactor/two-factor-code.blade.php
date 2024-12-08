<section class="w-3/4">
    <h3 class="text-white">{{__('using TOTP')}}</h3>
    <p class="text-sm text-gray-200 mb-6">
        {{ __('please enter your authentication code to login')}}.
    </p>
    <form method="POST" action="{{route('two-factor.login')}}" class="formAction">
        @csrf
        <div class="mb-3">
            <div class="flex items-center border border-slate-200 rounded">
                <x-main::input.label for="code" :value="__('code')" class="flex flex-col justify-center items-center !mb-0 p-3 text-white border-e border-slate-200"/>
                <input type="text" id="code" name="code" title="{{__('code')}}"
                       class="block w-full bg-transparent px-3 py-2 focus:outline-none text-white"
                       placeholder="{{__('enter the code from google app authentication')}}"/>
            </div>
            <x-main::input.error :messages="$errors->get('code')" class="mt-2"/>
        </div>

        <div class="">
            <x-main::button.primary class="block w-full" type="submit" rol="button" title="{{ __('confirm') }}">
                {{ __('confirm') }}
            </x-main::button.primary>
        </div>
    </form>
</section>
