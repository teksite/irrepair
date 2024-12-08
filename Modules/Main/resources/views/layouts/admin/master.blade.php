<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
    <link rel="icon" type="image/png" sizes="32x32" href="/uploads/favicon/favicon-32x32.png">
    @vite(['Modules/Main/resources/assets/css/admin.css', 'Modules/Main/resources/assets/js/admin.js'])
    @stack('headerScripts')

    <title>@yield('title') | {{__(config('app.name', 'TEKsite')) }}</title>
</head>

<body class="m-0 text-base antialiased font-normal text-start bg-slate-100  p relative overflow-x-hidden" x-data="{sidebar:true ,togglesSidebar() { this.sidebar = !this.sidebar }}" >

<div class="absolute hidden xl:hidden bg-gray-200/50 backdrop-blur-2xl inset-0 w-full h-full z-40"></div>

@include('main::layouts.admin.partials.aside')
<main class="relative transition-all duration-200 ease-in-out rounded-xl xl:ms-72" :class="{'xl:ms-72':sidebar}">
    <x-main::errors-list />
    @include('main::layouts.admin.partials.header')
    <div class="mx-auto w-11/12 mb-3">
        {{$slot ?? ''}}
    </div>
    @include('main::layouts.admin.partials.footer')

</main>


@if(session()->has('reply'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            title: '{{session()->get('reply')['title'] ?? ''}}',
            text: '{{session()->get('reply')['message'] ?? ''}}',
            icon: '{{session()->get('reply')['type'] ?? ''}}',
            timer: 2000,
        });
    </script>

@endif
@stack('footerScripts')

</body>
</html>
