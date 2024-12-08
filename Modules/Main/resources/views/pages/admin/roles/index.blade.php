<x-main::admin-list-layout>
        @section('title' , __(':title list',['title'=>__('roles')]))
        @section('header-description' , __("in this window you can see all :title", ['title'=>__('roles')]))

        @section('hero-start-section')
            @can('role-create')
                <x-main::link.header :title="__('new :title',['title' =>__('role')])" :href="route('admin.roles.create')"/>
            @endcan
        @endsection
        @section('hero-end-section')
            <x-main::search/>
        @endsection

    @section('main')

        <x-main::box>
            <x-main::table :header="['id'=>'#','title'=>'title','description',]">
                @if($roles->count())
                    @foreach($roles as $key=>$role)
                        <tr class="group hover:bg-slate-100 ">
                            <td class="p-3">{{$roles->firstItem() + $key}}</td>
                            <td class="p-3">{{$role->title}}</td>
                            <td class="p-3">{{$role->description}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('role-edit')
                                        <x-main::link.edit :route="route('admin.roles.edit' , $role)" title="{{$role->title}}"/>
                                    @endcan

                                    @can('role-delete')
                                        <x-main::link.delete :route="route('admin.roles.destroy' , $role)" title="{{$role->title}}"/>
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
                @if($roles?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$roles->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

