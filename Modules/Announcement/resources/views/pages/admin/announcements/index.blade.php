<x-main::admin-list-layout>
        @section('title' , __(':title list',['title'=>__('announcements')]))
        @section('header-description' , __("in this window you can see all :title", ['title'=>__('announcements')]))

        @section('hero-start-section')
            @can('announcement-create')
                <x-main::link.header :title="__('new :title',['title' =>__('announcement')])" :href="route('admin.announcements.create')"/>
            @endcan
{{--                @can('announcement-delete')--}}
{{--                    <x-main::link.trash :route="route('admin.announcements.trash.index')" count="{{$trashCount}}"/>--}}
{{--                @endcan--}}
        @endsection
        @section('hero-end-section')
            <x-main::search/>
        @endsection

    @section('main')

        <x-main::box>
            <x-main::table :header="['id'=>'#','title'=>'title','creator_id'=>'author','created_at'=>'created at','pinned'=>'pinned',]">
                @if($announcements->count())
                    @foreach($announcements as $key=>$announcement)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$announcements->firstItem() + $key}}</td>
                            <td class="p-3">{{$announcement->title}}</td>
                            <td class="p-3">{{$announcement->creator->name}}</td>
                            <td class="p-3">{{$announcement->created_at}}</td>
                            <td class="p-3">{!! $announcement->pinned ? '<i class="tkicon fill-none stroke-blue-600" data-icon="pin"></i>' : '' !!}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                   <x-main::link.show :route="route('admin.announcements.show' , $announcement)" title="{{$announcement->title}}" :blank="false"/>
                                    @can('announcement-delete')
                                        <x-main::link.delete :route="route('admin.announcements.destroy' , $announcement)" title="{{$announcement->title}}"/>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="p-3">
                            <p class="text-center">
                                {{__('no item has been found')}}
                            </p>
                        </td>
                    </tr>
                @endif
                @if($announcements?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$announcements->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

