<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('widgets')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('widgets')]))

    @section('hero-start')
        @can('widget-create')
            <x-main::link.header :title="__('new :title',['title' =>__('widget')])" :href="route('admin.widgets.create')"/>
        @endcan
            @can('widget-delete')
                <x-main::link.trash :route="route('admin.widgets.trash.index')" count="{{$trashCount}}"/>
            @endcan
    @endsection
    @section('hero-end')
        <x-main::search/>
    @endsection

    @section('main')

        @if($widgets->count())
            <ul class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5">
                @foreach($widgets as $widget)
                    <li class="xbox group">
                        <span class="paragraph text-center font-bold block">
                            {{$widget->title}}
                        </span>
                        <span class="text-gray-300 group-hover:text-gray-900 text-center font-bold block mb-3 ">
                            {{$widget->label}}
                        </span>
                        <div class="flex items-center justify-center gap-6 visible lg:invisible group-hover:visible">

                            @can('widget-edit')
                                <x-main::link.edit :route="route('admin.widgets.edit' , $widget)" title="{{$widget->title}}"/>
                            @endcan

                            @can('widget-delete')
                                <x-main::link.delete :route="route('admin.widgets.destroy' , $widget)" title="{{$widget->title}}"/>
                            @endcan
                        </div>

                    </li>
                @endforeach
            </ul>
        @else
            <tr>
                <td colspan="6" class="p-3">
                    <p class="text-center">
                        {{__('no item has been found')}}
                    </p>
                </td>
            </tr>
        @endif
        @if($widgets?->links())
            <x-slot:foot>
                <tr>
                    <td colspan="4" class="p-3">
                        {{$widgets->appends($_GET)->links()}}
                    </td>
                </tr>
            </x-slot:foot>
        @endif
    @endsection

</x-main::admin-list-layout>

