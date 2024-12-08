<x-main::admin-layout>
    @section('title')
        @yield('title')
    @endsection

    @section('header-description')
        <p class="text-slate-50">
            {{ __('in this window you can see list of :title trashes, restore them or delete them forever', ['title' => __($title)]) }}
        </p>

        <p class="text-red-600 -mb-6">
            {{__('deleting any item from the below list causes you missed it and its related item such as its comments forever')}}
        </p>
    @endsection

    @section('hero-start')
        <x-main::link.header :title="__('all')" :href="$indexRoute"/>
    @endsection

    @section('hero-end')
        <form method="POST" action="{{ $restoreAllRoute }}" id="restore-trash">
            @csrf
            @method('patch')
        </form>
        <button type="button" class="restore-trash-btn border border-blue-900 text-blue-900 px-3 py-2 rounded text-xs font-bold"
                title="{{ __('restore all') }}"
                onclick="event.preventDefault();document.getElementById('restore-trash').submit()">
            {{ __('restore all') }}
        </button>

        <form method="POST" action="{{ $deleteAllRoute }}" id="flush-trash">
            @csrf
            @method('delete')
        </form>
        <button type="button" class="clear-trash-btn delete-item-btn border border-red-900 text-red-900 px-3 py-2 rounded text-xs font-bold"
                title="{{ __('clear all') }}" data-target="flush-trash">
            {{ __('clear all') }}
        </button>

    @endsection

    <x-main::box>
        @if($instances->count())
            <x-main::table :header="[...array_keys($columns), '']">
                @foreach($instances as $instance)
                    <tr class="group hover:bg-slate-100">
                        @foreach($columns as $column)
                            <td class="p-3">
                                {{ data_get($instance, str_replace('->', '.', $column)) }}
                            </td>
                        @endforeach
                        <td class="p-3">
                            <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                <form method="POST" action="{{ route($restoreRoute, $instance) }}" id="instance-restore-{{ $instance->id }}">
                                    @csrf
                                    @method('PATCH')
                                </form>
                                <button type="button" class="restore-item-btn"
                                        onclick="event.preventDefault();document.getElementById('instance-restore-{{ $instance->id }}').submit()"
                                        title="{{ __('restore') }}">
                                    <i class="tkicon fill-none stroke-green-900" data-icon="recycle" size="20"></i>
                                </button>

                                <form method="POST" action="{{ route($deleteRoute, $instance) }}" id="instance-prune-{{ $instance->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a class="flex items-center justify-center gap-1 delete-item-btn " title="{{__('delete')}}" data-target="instance-prune-{{ $instance->id }}">
                                    <i class="tkicon stroke-red-700 hover:stroke-red-900 fill-none hover:stroke-2" data-icon="trash" size="18"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-main::table>

            @if($instances->hasPages())
                <x-slot:foot>
                    <tr>
                        <td colspan="4" class="p-3">
                            {{ $instances->appends(request()->query())->links() }}
                        </td>
                    </tr>
                </x-slot:foot>
            @endif
        @else
            <tr>
                <td colspan="6" class="p-3">
                    <p class="text-center">{{ __('no item has been found') }}</p>
                </td>
            </tr>
        @endif

        @yield('main')
    </x-main::box>
</x-main::admin-layout>
