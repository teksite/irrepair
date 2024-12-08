<x-main::panel-layout>
    @section('title',__('announcements'))
    @section('hero-start')
        <h2>
            @if(request()->status ==='seen')
                {{__('seen :title',['title'=>__('announcements')])}}
            @else
                {{__('unseen :title',['title'=>__('announcements')])}}
            @endif
        </h2>
    @endsection
    @section('hero-end')
            <x-main::link.header :title="__('seen')" :href="route('panel.announcements.index') .'?status=seen'" icon="eye" class="flex items-center gap-1 text-blue-600"/>
            <x-main::link.header :title="__('unseen')" :href="route('panel.announcements.index')" icon="eye-off" class="flex items-center gap-1 text-blue-600"/>
    @endsection

    @if($pinnedAnnouncements->count() )
        <div class="mb-6">
            <ul class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($pinnedAnnouncements as $announcement)
                    <li class="p-3 border-2 border-orange-300 {{$announcement->pivot->read_at ? 'text-gray-200' : ''}} bg-white rounded-2xl overflow-hidden">
                        <div class="flex items-center gap-3">
                            <i class="tkicon  fill-none stroke-current" data-icon="pin" size="32"></i>
                            <a href="{{route('panel.announcements.show',$announcement)}}">
                            <span class="block {{$announcement->pivot->read_at ?: 'font-bold'}} text-lg min-w-fit">
                                {{$announcement->title}}
                            </span>
                            </a>
                        </div>

                        <div class="flex items-center justify-end text-xs mt-1">
                            <a href="{{route('panel.announcements.show',$announcement)}}"
                               class="regular">{{__('read')}}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($announcements->count())
        <ul class="space-y-3 mb-6">
            @foreach($announcements as $announcement)
                <li>
                    <div class="flex items-center justify-between gap-6 hover:bg-gray-100 bg-white shadow-lg rounded-xl p-1">
                       <div class="flex items-center gap-3 py-2">
                               <i class="tkicon fill-none stroke-2 {{$announcement->pivot->read_at ? 'stroke-gray-300': 'stroke-blue-600'}}" size="24" data-icon="info-circle"></i>
                           <p class="text-sm !mb-0 {{$announcement->pivot->read_at ? 'text-gray-600': 'text-blue-600 font-bold'}}">
                               {{$announcement->message}}
                           </p>
                       </div>
                       <a href="{{route('panel.announcements.show',$announcement)}}" class="regular text-sm p-1">
                           <i class="tkicon fill-none stroke-blue-600" size="16" data-icon="eye"></i>
                       </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="my-3">
        <form action="{{route('panel.announcements.mark')}}" method="POST">
            @csrf @method('PATCH')
            <div class="inline-flex items-center gap-1 bg-white border border-slate-200 rounded-xl pe-3">
                <x-main::input.select name="actionType">
                    <option value="*">{{__('mark as read')}}</option>
                </x-main::input.select>
                <button class="px-3 py-1">{{__('apply')}}</button>
            </div>
        </form>
    </div>
</x-main::panel-layout>
