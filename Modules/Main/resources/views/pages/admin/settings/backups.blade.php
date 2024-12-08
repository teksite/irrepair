<x-main::admin-layout>
    @section('title' , __(':title list',['title'=>__('tables')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('tables')]))

    @section('hero-start')
{{--        @can('role-create')--}}
{{--            <x-main::link-header :title="__('new :title',['title' =>__('role')])" :href="route('admin.roles.create')"/>--}}
{{--        @endcan--}}
    @endsection
    @section('hero-end')
    @endsection

    <x-main::box>
        <x-main::table :header="['#','title',]">
                @foreach($tables ?? [] as $table)
                    <tr class="group hover:bg-slate-100">
                        <td class="p-3">{{$loop->iteration}}</td>
                        <td class="p-3">{{$table}}</td>
                        <td class="p-3">
                            <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                              {{--  @can('role-edit')
                                    <x-main::link-edit :route="route('admin.roles.edit' , $role)" title="{{$role->name}}"/>
                                @endcan

                                @can('role-delete')
                                    <x-main::link-delete :route="route('admin.roles.destroy' , $role)" title="{{$role->name}}"/>
                                @endcan--}}
                            </div>
                        </td>
                    </tr>
                @endforeach
        </x-main::table>
    </x-main::box>
</x-main::admin-layout>
