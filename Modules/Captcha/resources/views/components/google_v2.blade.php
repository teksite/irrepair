@php
    $captcha= \Modules\Main\Models\Setting::query()->firstWhere('key','google_v2_captcha');
          if($captcha && $captcha->stance =='on' && $captcha->value){
              $siteKet=$captcha->value['site_key'];
              $siteSecret=$captcha->value['secret_key'];
          }

@endphp
@isset($siteKet, $siteSecret)
    <div {!! $attributes->merge(['class' => 'g-recaptcha']) !!} data-sitekey="{{$siteKet}}"></div>
    <x-main::input.error :messages="$errors->get('g-recaptcha-response')" class="mt-2"/>
@endisset

@push('footerScripts')
    <script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>
@endpush

