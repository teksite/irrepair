@can('client-announcement-read')
    <a href="{{route('panel.announcements.index')}}" class="relative">
        <i class="tkicon icon fill-none stroke-current" data-icon="bell-ring"></i>
        <span class="absolute top-0 end-0 bg-red-600 dark:bg-red-600 p-0.5 rounded-lg text-gray-50 text-xs leading-none">
            {{auth()->user()->announcements()->wherePivotNull('read_at')->count() ?? 0 }}
        </span>
    </a>
@endcan
