<x-main::auth-layout>
    @section('title','two factor authentication challenge')

    <div class="p-3">
        <div class="flex items-center justify-center gap-3 mb-6">
            <i class="tkicon fill-none stroke-gray-200 block text-center" size="50" data-icon="lock-opened"></i>
            <h2 class="text-center text-gray-200 mb-0">{{__('two factor authentication')}}</h2>
        </div>

        <div class="slider">
            <div class="slide {{$errors->has('code') ? 'active-slide' : ''}}" id="0">
                @include('pages.auth.twofactor.two-factor-code')
            </div>
            <div class="slide {{$errors->has('recovery_code') ? 'active-slide' : ''}}" id="1">
                @include('pages.auth.twofactor.two-factor-recovery-code')

            </div>
            <div class="slide {{$errors->has('sent_code') ? 'active-slide' : ''}}" id="2">
                @include('pages.auth.twofactor.two-factor-send-code')
            </div>
        </div>
    </div>
    <div class="dots-container">
        <hr class="my-3">
        <p class="text-sm font-bold text-white">{{__('other ways')}}</p>
        <div class="flex justify-between items-center">
            <button type="button" title="{{__('by :title',['title'=>__('TOTP')])}}"
                    class="dot text-sm text-gray-200 px-3 py-1" data-slide="0">
                {{__('TOTP')}}
            </button>
            <button type="button" title="{{__('by :title',['title'=>__('recovery code')])}}"
                    class="dot text-sm text-gray-200 px-3 py-1" data-slide="1">
                {{__('recovery code')}}
            </button>
            <button type="button" title="{{__('by :title',['title'=>__('one time code')])}}"
                    class="dot text-sm text-gray-200 px-3 py-1" data-slide="2">
                {{__('one time code')}}
            </button>
        </div>
    </div>
        <hr>
        <div class="flex justify-between items-center gap-3 mt-3 px-3">
            <div class="w-full">
                <x-errors-list />
            </div>
            <div class="w-full flex justify-end">
                <x-back-home />
            </div>
        </div>
</x-main::auth-layout>
