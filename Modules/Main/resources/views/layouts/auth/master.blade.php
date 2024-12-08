@php use Illuminate\Support\Facades\Storage;use Illuminate\Support\Facades\URL; @endphp
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

    <title>@yield('title') | {{__(config('app.name', 'TEKsite'))}}</title>
</head>

<body class="m-0 text-base antialiased font-normal bg-slate-200 relative overflow-x-hidden">

<main class="relative transition-all duration-200 ease-in-out rounded-xl">
    <section class="w-full min-h-screen flex flex-col justify-center items-center bg-back-1 bg-no-repeat bg-cover bg-center p-3">
        <div class="w-11/12 md:w-3/4 2xl:w-2/3">
            <div class="grid lg:grid-cols-2 overflow-hidden">
                <div>
                    {{$slot ?? ''}}
                </div>
                @include('main::layouts.auth.partials.contact-ways')
            </div>
        </div>
    </section>
</main>

@stack('footerScripts')

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
</body>
</html>
