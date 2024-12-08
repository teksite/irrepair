<div class="grid gap-6 md:grid-cols-2" xmlns:x-main="http://www.w3.org/1999/html">
    <form action="{{route('admin.settings.captcha.update')}}" method="POST">
        @csrf @method('PATCH')
        <div class="flex gap-6 items-center justify-start">
            <div class="flex justify-start gap-1 items-start">
                <x-main::input.label for="google_v2_captcha_disabled" value="{{__('deactivate')}}"/>
                <x-main::input.radio id="google_v2_captcha_disabled" value="off" class="block mt-1 accent-green-800"  name="captcha[google_v2_captcha][stance]"
                                     :checked="!isset($data['google_v2_captcha']['stance']) || $data['google_v2_captcha']['stance'] ==='off' "/>
            </div>
            <div class="flex justify-start gap-1 items-start">
                <x-main::input.label for="google_v2_captcha_captcha_enable" value="{{__('activate')}}"/>
                <x-main::input.radio id="google_v2_captcha_captcha_enable" value="on" class="block mt-1 accent-green-800" name="captcha[google_v2_captcha][stance]"
                                     :checked="isset($data['google_v2_captcha']['stance']) && $data['google_v2_captcha']['stance'] ==='on' "/>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('captcha.google_v2_captcha.stance')" class="mt-2"/>

        <div class="my-3">
            <x-main::input.label for="siteKey" value="site key"/>
            <x-main::input.text dir="ltr" id="siteKey" class="block mt-1 w-full" type="text" name="captcha[google_v2_captcha][data][site_key]"
                                :value="old('captcha.google_v2_captcha.data.site_key') ?? $data['google_v2_captcha']['value']['site_key'] ?? '' "/>
            <x-main::input.error :messages="$errors->get('captcha.google_v2_captcha.data.site_key')" class="mt-2"/>
        </div>

        <div class="my-3">
            <x-main::input.label for="secretKey" value="secret key"/>
            <x-main::input.text dir="ltr" id="secretKey" class="block mt-1 w-full" type="text" name="captcha[google_v2_captcha][data][secret_key]"
                                :value="old('captcha.google_v2_captcha.data.secret_key')  ??  $data['google_v2_captcha']['value']['secret_key'] ?? '' "/>
            <x-main::input.error :messages="$errors->get('captcha.google_v2_captcha.data.secret_key')" class="mt-2"/>
        </div>


        <div class="flex items-center justify-end">
            <x-main::button.primary>
                {{__('update')}}
            </x-main::button.primary>
        </div>
    </form>
    <div class="p-6 rounded border border-slate-200">
        <p>
            {{__('to use google_v2_captcha captcha, use the below component in your form')}}.
        </p>
        <div class="" dir="ltr">
            <span><</span>x-captcha::google_v2_captcha <span>/></span>
        </div>
        <p>
            {{__('then use the below rule in validation of data')}}.
        </p>
        <div dir="ltr">
            use Modules\Captcha\Rules\GoogleV2CaptchaRule
            <br>
            new GoogleV2CaptchaRule()
        </div>
    </div>
</div>
