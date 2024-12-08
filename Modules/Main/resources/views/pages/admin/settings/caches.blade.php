<x-main::admin-layout>
    @section('title' , __('caches'))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('caches')]))


    <section class="mb-6 grid md:grid-cols-2 gap-6">
    <div>
        @foreach($types ?? [] as $type)
            <x-main::box class="flex items-center justify-between mb-6">
                <h2 class="!mb-0">{{$type}}</h2>

                <div class="flex items-center justify-end">
                    <div class="px-3 py-1">
                        @if(!in_array($type ,['cache' , 'optimize','response']))
                            <form method="POST" action="{{route('admin.settings.caches.store' ,['type'=>$type])}}">
                                @csrf
                                <button type="submit" role="button" title="{{__('save')}}">
                                    <i class="tkicon stroke-sky-700 hover:stroke-sky-900 hover:stroke-2" data-icon="box-arrow-in" size="18"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="px-3 py-1">
                        <form method="POST" action="{{route('admin.settings.caches.destroy' ,['type'=>$type])}}">
                            @csrf @method('DELETE')
                            <button type="submit" role="button" title="{{__('destroy')}}">
                                <i class="tkicon stroke-red-700 hover:stroke-red-900 fill-none hover:stroke-2" data-icon="trash" size="18"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </x-main::box>
        @endforeach
    </div>

    </section>

</x-main::admin-layout>
