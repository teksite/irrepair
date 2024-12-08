@props(['editAddressPage'=>null])
<div class="floating-menu-box">
    <div class="floating_menu" id="floating_menu">
        <button type="button" id="floating_menu-button" class="floating_menu-button" title="admin dashboard">
            <i class="tkicon fill-none stroke-white" data-icon="bar-3"></i>
        </button>
        <ul class="floating_menu-list">
            <li class="floating_menu-item">
                <form method="POST" action="{{ route('logout') }}" class="logout">
                    @csrf
                </form>
                <button type="button" role="button" title="{{__('log out')}}"
                        onclick="event.preventDefault();document.querySelector('form.logout').submit();">
                    <i class="tkicon turn-off fill-none stroke-red-600" size="16"></i>
                </button>
            </li>
            <li class="floating_menu-item">
                <a href="{{route('admin.index')}}" title="{{__('admin dashboard')}}">
                    <i class="tkicon gears fill-none stroke-white"></i>
                </a>
            </li>
            <li class="floating_menu-item">
                <a href="{{route('panel.index')}}" title="{{__('user panel')}}">
                    <i class="tkicon user fill-none stroke-white"></i>
                </a>
            </li>
            @if($editAddressPage)
                <li class="floating_menu-item">
                    <a href="{{$editAddressPage}}" target="_blank" title="{{__('edit')}}" id="adminEditPageLink">
                        <i class="tkicon pen fill-none stroke-white"></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
@push('footerScripts')
    <script>
        /* Admin Bar */
        document.querySelector('#floating_menu-button').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#floating_menu').classList.toggle('active')
        });

    </script>
@endpush
