<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP</title>
    <style>
        @include('main::emails.assets.style')
    </style>
</head>
<body>
<div class="panel">
    <div class="inner-body">
        <div class="logo-box">
            <img src=" {{config('app.url').'/uploads/logo/logo.png'}}" alt="{{__(config('app.name'))}}" width="682" height="512">
        </div>
        <div class="inner-container">
            {{-- Greeting --}}
            <h2>
                <span class="text-hello"> # {{__('dear :title', ['title'=>$user['name']])}}</span>
            </h2>
            {{-- Intro Lines --}}
           <p>
               {{__('your requested OTP code in :title',['title'=>__(config('app.name'))])}}:
           </p>

            <span style="background-color: #1a202c;color: #fff; padding: 8px 16px; border-radius: 16px;display: inline-block;margin: 32px auto">
                {{$code}}
            </span>
            <p>
                {{__('if you have any problem you can have contact with out support crew')}}
            </p>

        </div>
    </div>
</div>
</body>
</html>
