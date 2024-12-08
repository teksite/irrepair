<x-main::admin-credix-layout>
    @section('title',__('permissions'))
    @section('header-description',__('in this window you can see all :title and create new one',['title'=>__('permissions')]))

    @section('formRoute' ,route('admin.permissions.store'))

    @can('permission-edit')
        @section('form')
            <div class="my-3">
                <x-main::input.label for="title" value="{{__('title')}}"/>
                <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title')"/>
                <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
            </div>

            <div class="my-3">
                <x-main::input.label for="description" value="{{__('description')}}"/>
                <x-main::input.text id="description" class="block mt-1 w-full" type="text" name="description"
                                    :value="old('description')"/>
                <x-main::input.error :messages="$errors->get('description')" class="mt-2"/>
            </div>
        @endsection
    @endcanany

    @section('index')

        <x-main::box>
            <div class="flex justify-end items-center mb-6">
                <x-main::search/>
            </div>
            <x-main::table :header="['id'=>'#','title'=>'title','description'=>'description',]">
                @if($permissions->count())
                    @foreach($permissions as $key=>$permission)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$permissions->firstItem() + $key}}</td>
                            <td class="p-3">{{$permission->title}}</td>
                            <td class="p-3">{{$permission->description}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('permission-edit')
                                        <x-main::link.edit :route="route('admin.permissions.edit' , $permission)"
                                                           title="{{$permission->title}}"/>
                                    @endcan

                                    @can('permission-delete')
                                        <x-main::link.delete :route="route('admin.permissions.destroy' , $permission)" title="{{$permission->title}}"/>
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
                @if($permissions?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$permissions->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>

    @endsection

</x-main::admin-credix-layout>

