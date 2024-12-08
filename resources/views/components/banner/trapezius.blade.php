@props(['angle'=>'top-right'])
<header class="bg-zinc-800 pt-12 bg-no-repeat bg-cover bg-theme-1">
    <div class="inner-container">
        {!! $slot ?? '' !!}
    </div>
    <div class="trapezius {{$angle}} bg-white h-24 lg:h-36 bg-no-repeat bg-cover"></div>
</header>
