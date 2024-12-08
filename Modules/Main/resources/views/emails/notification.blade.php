<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('notification')}}</title>
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
                @if (! empty($greeting))
                    # {{ $greeting }}
                @else
                    @if ($level === 'error')
                        # @lang('Whoops!')
                    @else
                        <span class="text-hello"> # @lang('Hello!') </span>
                    @endif
            </h2>
            @endif

            {{-- Intro Lines --}}
            @foreach ($introLines as $line)
                <p>
                    {!!  $line !!}
                </p>
            @endforeach

            {{-- Action Button --}}
            @isset($actionText)
                    <?php
                    $color = match ($level) {
                        'success', 'error' => $level,
                        default => 'primary',
                    };
                    ?>
                <x-mail::button :url="$actionUrl" :color="$color">
                    {{ $actionText }}
                </x-mail::button>
            @endisset

            {{-- Action Button --}}
            @isset($mainText)
                {{$mainText}}
            @endisset

            {{-- Outro Lines --}}
            @foreach ($outroLines as $line)
                <p>
                    {!!  $line !!}
                </p>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
