<x-main::admin-list-layout>
        @section('title' , __(':title list',['title'=>__('pages')]))
        @section('header-description' , __("in this window you can see all :title", ['title'=>__('pages')]))

        @section('hero-start-section')
            @can('page-create')
                <x-main::link.header :title="__('new :title',['title' =>__('page')])" :href="route('admin.pages.create')"/>
            @endcan
                @can('page-delete')
                    <x-main::link.trash :route="route('admin.pages.trash.index')" count="{{$trashCount}}"/>
                @endcan
        @endsection
        @section('hero-end-section')
            <x-main::search/>
        @endsection

    @section('main')

        <x-main::box>
            <x-main::table :header="['id'=>'#','image' ,'title'=>'title' ,'status'=>'status','created_at'=>'created at','published_at'=>'published at',]">
                @if($pages->count())
                    @foreach($pages as $key=>$page)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$pages->firstItem() + $key}}</td>
                            <td class="p-3"><img src="{{$page->featured_image}}" alt="{{$page->title}}" width="150" height="50"></td>
                            <td class="p-3">{{$page->title}}</td>
                            <td class="p-3">{{__($page->status->value)}}</td>
                            <td class="p-3">{{$page->created_at}}</td>
                            <td class="p-3">{{$page->published_at}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('page-edit')
                                        <x-main::link.edit :route="route('admin.pages.edit' , $page)" title="{{$page->title}}"/>
                                    @endcan
                                        <x-main::link.show :route="route('admin.pages.show' , $page)" title="{{$page->title}}"/>

                                    @can('page-delete')
                                        <x-main::link.delete :route="route('admin.pages.destroy' , $page)" title="{{$page->title}}"/>
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
                @if($pages?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$pages->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

