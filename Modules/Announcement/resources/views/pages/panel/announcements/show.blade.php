<x-main::panel-layout>
    @section('title',__('announcements'))
    @section('hero-start')
        <x-main::link.header :title="__('all')" :href="route('panel.announcements.index')"  icon="list" class="flex items-center gap-1 text-blue-600"/>
    @endsection
    @section('hero-end')
    @endsection
    <x-main::box>
        <div class="flex items-center justify-between mb-6">
            <h2 class="mb-0">{{$announcement->title}}</h2>
            <span class="text-sm">{{__('read at')}} : {{dateAdapter($announcement->user()->pivot->read_at)}}</span>
        </div>
        <div class="p-3 border border-slate-200 rounded-lg">
            {!! $announcement->message !!}
        </div>
    </x-main::box>
</x-main::panel-layout>
