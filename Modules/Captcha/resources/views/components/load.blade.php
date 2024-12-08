@php use Modules\Main\Models\Setting; @endphp
@props(['type'])
@php
    $g2=Setting::query()->firstWhere('key',"google_v2_captcha");
        $g2_stance = $g2 ? $g2->stance : 'off' ;
    $local=Setting::query()->firstWhere('key',"local_captcha");
        $local_stance = $local ? $local->stance : 'off' ;
@endphp
@if($g2_stance =='on')
    <x-captcha::google_v2 />
@elseif($local_stance =='on')
    <x-captcha::local />
@endif




