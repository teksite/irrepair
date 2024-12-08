@php
    $rand=rand(123,987)
@endphp
<div class="">
    <div class="inline-flex items-stretch bg-white border border-slate-200 rounded-lg overflow-hidden">
        <input type="text" name="g-recaptcha-response" id="captcha-code" class="focus:outline-none px-1 w-full !text-black" required>
        <label for="captcha-code" class="min-w-fit">
            <img data-id="{{$rand}}" src="{!! \Modules\Captcha\services\Facade\Captcha::src('custom') !!}" alt="captcha code" class="recaptcha-image h-full min-h-full w-auto" width="120" height="36">
        </label>
        <button aria-label="{{__('new captcha code')}}" type="button" role="button" class="py-1 px-3 reload-captcha-btn transition-all duration-300 ease-in-out outline-none focus:outline-none" data-for="{{$rand}}" title="{{__('reload')}}">
            <i class="tkicon recaptchaReloadBTN fill-none stroke-sky-600 stroke-2" data-icon="reload" size="16"></i>
        </button>
    </div>
    <x-main::input.error :messages="$errors->get('g-recaptcha-response')" class="mt-2"/>
</div>
@push('footerScripts')
    @vite(['Modules/Captcha/resources/assets/js/app.js'])
@endpush
