<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('batches')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('batches')]))

    @section('hero-start-section')

    @endsection
    @section('main')
        <x-main::box>
            <x-main::table
                :header="['','id'=>'id','name'=>'name','total_jobs'=>'total','pending_jobs'=>'pending','failed_jobs'=>'failed','created_at'=>'created at','finished_at'=>'finished at','cancelledـat'=>'cancelled at',]">
                @if($batches->count())
                    @foreach($batches as $batch)
                        @php($batch=get_object_vars($batch))
                        <tr class="group hover:bg-slate-100 ">

                            <td class="p-3">
                                <span @class([
   'bg-green-600 rounded-full aspect-square w-3 h-3 block'=>$batch['finished_at'] && is_null($batch['cancelled_at']),
   'bg-red-600 rounded-full aspect-square w-3 h-3 block'=>$batch['cancelled_at'],
   'bg-blue-600 rounded-full aspect-square w-3 h-3 block'=>is_null($batch['finished_at']) && is_null($batch['cancelled_at'])
])></span>
                            </td>
                            <td class="p-3">{{$batch['id']}}</td>
                            <td class="p-3">{{$batch['name']}}</td>
                            <td class="p-3 font-bold text-sm">{{$batch['total_jobs']}}</td>
                            <td class="p-3 text-yellow-600 font-bold text-sm">{{$batch['pending_jobs']}}</td>
                            <td class="p-3 text-red-600 font-bold text-sm">{{$batch['failed_jobs']}}</td>
                            <td class="p-3 text-sm">{{\Carbon\Carbon::parse($batch['created_at'])->format('Y-m-d H:i')}}</td>
                            <td class="p-3 text-sm">{{\Carbon\Carbon::parse($batch['finished_at'])->format('Y-m-d H:i')}}</td>
                            <td class="p-3 text-sm">{{\Carbon\Carbon::parse($batch['cancelled_at'])->format('Y-m-d H:i')}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    <form method="POST"
                                          action="{{route('admin.settings.batchjobs.destroy' ,$batch['id'])}}">
                                        @csrf @method('delete')
                                        <button>
                                            <i class="tkicon fill-none stroke-red-600" data-icon="trash" size="18"></i>
                                        </button>
                                    </form>
                                    <form method="POST"
                                          action="{{route('admin.settings.batchjobs.cancel' ,$batch['id'])}}">
                                        @csrf @method('delete')
                                        <button>
                                            <i class="tkicon fill-none stroke-orange-600" data-icon="no-symbol" size="18"></i>
                                        </button>
                                    </form>
                                    <form method="POST"
                                          action="{{route('admin.settings.batchjobs.retry' ,$batch['id'])}}">
                                        @csrf @method('patch')
                                        <button>
                                            <i class="tkicon fill-none stroke-blue-600" data-icon="reload" size="18"></i>
                                        </button>
                                    </form>

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

