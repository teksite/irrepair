<div class="grid gap-6 md:grid-cols-2">
    <form action="{{route('admin.settings.captcha.update')}}" method="POST">
          @csrf @method('PATCH')
          <div class="flex gap-6 items-center justify-start">
              <div class="flex justify-start gap-1 items-start">
                  <x-main::input.label for="local_captcha_disabled" value="{{__('deactivate')}}"/>
                  <x-main::input.radio id="local_captcha_disabled" value="off" class="block mt-1 accent-green-800"  name="captcha[local_captcha][stance]"
                                       :checked="!isset($data['local_captcha']['stance']) || $data['local_captcha']['stance'] ==='off' "/>
              </div>
              <div class="flex justify-start gap-1 items-start">
                  <x-main::input.label for="local_captcha_captcha_enable" value="{{__('activate')}}"/>
                  <x-main::input.radio id="local_captcha_captcha_enable" value="on" class="block mt-1 accent-green-800" name="captcha[local_captcha][stance]"
                                       :checked="isset($data['local_captcha']['stance']) && $data['local_captcha']['stance'] ==='on' "/>
              </div>
            </div>
        <x-main::input.error :messages="$errors->get('captcha.local_captcha.stance')" class="mt-2"/>

        <div class="flex items-center justify-end">
            <x-main::button.primary>
                {{__('update')}}
            </x-main::button.primary>
        </div>
    </form>
    <div class="p-6 rounded border border-slate-200">
        <p>
            {{__('to use local captcha, use the below component in your form')}}.
        </p>
        <div class="" dir="ltr">
            <span><</span>x-captcha::local <span>/></span>
        </div>
        <p>
            {{__('then use the below rule in validation of data')}}.
        </p>
        <div dir="ltr">
            use Modules\Captcha\Rules\LocalCaptchaRule
            <br>
            new LocalCaptchaRule()
        </div>
    </div>
</div>
