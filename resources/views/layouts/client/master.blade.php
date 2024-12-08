<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="57x57" href="/uploads/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/uploads/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/uploads/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/uploads/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/uploads/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/uploads/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/uploads/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/uploads/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/uploads/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/uploads/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/uploads/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/uploads/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/uploads/favicon/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
{{--    <base href="https://ir-repair.ir/">--}}
    {!! $seo ?? '' !!}
    @stack('seo')
    @vite(['resources/js/app.js', 'resources/css/app.css','resources/font/font.css'])
    <link rel="stylesheet" href="/assets/css/style.css">
    @stack('headerScripts')
</head>
<body x-data="{sidebar:false ,togglesSidebar() { this.sidebar = !this.sidebar }}" @resize.window="sidebar = false" :class="sidebar ? 'overflow-hidden' : ''" id="site-body" class="font-vazir relative bg-white  overflow-x-hidden min-h-svh">
<x-show-errors/>
<x-loader.circle />
@include('layouts.client.partials.header')
    {{$slot ?? ''}}
@include('layouts.client.partials.footer')
@if(session()->has('reply'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            toast:'{{session()->get('reply')['toast'] ?? true}}',
            position: 'center-center',
            showConfirmButton: false,
            title: '{{session()->get('reply')['title'] ?? ''}}',
            text: '{{session()->get('reply')['message'] ?? ''}}',
            icon: '{{session()->get('reply')['type'] ?? 'success'}}',
            timer: 2000,
        });
    </script>
@endif
@can('admin')
    <x-main::admin-navbar :editAddressPage="$editAddressPage ?? null"/>
@endcan
<div x-bind:aria-expanded="sidebar" :class="sidebar ? 'block overflow-hidden' : 'hidden'" @click="sidebar=false" class="z-40 absolute w-full h-full bg-gray-600/50 backdrop-blur-2xl inset-0 xl:hidden overflow-hidden pointer-events-none"></div>
@stack('footerScripts')
<script src="{{asset('assets/js/javascript.js')}}"></script>
</body>
</html>
