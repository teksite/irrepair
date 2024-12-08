@php
$random='logout-'.rand(100,999)
 @endphp
<div class="group">
    <form method="POST" action="{{ route('logout') }}" class="logout" id="{{$random}}">
        @csrf
    </form>
    <button type="button" role="button" title="{{__('log out')}}" class="text-red-700 group-hover:text-red-900 stroke-red-700 group-hover:stroke-red-900 flex items-center gap-1 text-sm"
       onclick="event.preventDefault();document.querySelector('form.logout').submit();">
        <i class="tkicon fill-none stroke-red-700" data-icon="turn-off" size="16"></i>
        {{__('log out')}}
    </button>
</div>
