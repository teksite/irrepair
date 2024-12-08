<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('jobs')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('jobs')]))

    @section('hero-start-section')

    @endsection


    @section('main')
        <x-main::box>
            <x-main::table :header="['id'=>'id','uuid'=>'uuid','connection'=>'connection','queue'=>'queue']">
                @if($jobs->count())
                    @foreach($jobs as $job)
                        @php($jb=get_object_vars($job))
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$jb['id']}}</td>
                            <td class="p-3">{{$jb['uuid']}}</td>
                            <td class="p-3">{{$jb['connection']}}</td>
                            <td class="p-3">{{$jb['queue']}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                <x-main::link.reload :route="route('admin.settings.jobs.reload' , ['uuid'=>$jb['uuid']])"/>
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
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

