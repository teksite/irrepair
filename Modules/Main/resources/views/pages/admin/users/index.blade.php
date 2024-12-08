<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('users')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('users')]))

    @section('hero-start-section')
        @can('user-create')
            <x-main::link.header :title="__('new :title',['title' =>__('user')])" :href="route('admin.users.create')"/>
        @endcan
    @endsection
    @section('hero-end-section')
        <x-main::search/>
    @endsection

    @section('main')
        <x-main::box>
            <x-main::table :header="['id'=>'#','title'=>'title','email'=>'email','phone'=>'phone','role',]">
                @if($users->count())
                    @foreach($users as $key=>$user)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$users->firstItem() + $key}}</td>
                            <td class="p-3">{{$user->name}}</td>
                            <td class="p-3">{{$user->email}}</td>
                            <td class="p-3">{{$user->phone}}</td>
                            <td class="p-3 text-xs">{{$user->roles->pluck('title')->implode(',')}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @if(\Illuminate\Support\Facades\Route::has('users.show'))
                                        <x-main::link.show :route="route('users.show' , $user)" :title="__(':title profile',['title'=>$user->name])"/>
                                    @endcan
                                    @can('user-edit')
                                        <x-main::link.edit :route="route('admin.users.edit' , $user)" title="{{$user->name}}"/>
                                    @endcan

                                    @can('user-delete')
                                        <x-main::link.delete :route="route('admin.users.destroy' , $user)" title="{{$user->name}}"/>
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
                @if($users?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$users->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

