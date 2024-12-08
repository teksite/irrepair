<div class="group">
    <form method="POST" action="{{ route('logout') }}" class="logout">
        @csrf
    </form>
    <button type="button" role="button" title="{{__('log out')}}"
       class="text-red-700 group-hover:text-red-900 flex items-center gap-1 text-sm"
       onclick="event.preventDefault();document.querySelector('form.logout').submit();">
        <i class="tkicon fill-none stroke-red-600 hover:stroke-red-800" size="16" data-icon="turn-off"></i>
        {{__('log out')}}
    </button>
</div>
