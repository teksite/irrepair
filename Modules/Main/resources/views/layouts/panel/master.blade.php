<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
    <link rel="icon" type="image/png" sizes="32x32" href="/uploads/favicon/favicon-32x32.png">

    @vite(['Modules/Main/resources/assets/css/panel.css', 'Modules/Main/resources/assets/js/panel.js'])

    @stack('headerScripts')
    <title>@yield('title') | {{__(config('app.name', 'TEKsite')) }}</title>
</head>

<body class="m-0 text-base antialiased font-normal text-start bg-slate-100 p relative overflow-x-hidden">
<div class="absolute w-full min-h-64 -z-10 bg-panel-header bg-cover bg-center bg-no-repeat">
    <div class="w-full min-h-64"></div>
</div>
<div class="absolute hidden xl:hidden bg-gray-200/50 backdrop-blur-2xl inset-0 w-full h-full z-40"></div>

@include('main::layouts.panel.partials.aside')

<main class="relative transition-all duration-200 ease-in-out xl:ms-72 rounded-xl">
    <div class="mx-auto xl:pe-6">
        @include('main::layouts.panel.partials.header')
        @include('main::layouts.panel.partials.hero')
        <x-main::errors-list/>
        {{$slot ?? ''}}
    </div>
</main>

@stack('footerScripts')

@if(session()->has('reply'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            position: 'center-center',
            showConfirmButton: false,
            title: '{{session()->get('reply')['title'] ?? ''}}',
            text: '{{session()->get('reply')['message'] ?? ''}}',
            icon: '{{session()->get('reply')['type'] ?? ''}}',
            timer: 2000,
        });
    </script>
@endif
</body>
</html>
