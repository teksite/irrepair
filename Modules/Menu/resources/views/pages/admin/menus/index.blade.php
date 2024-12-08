<x-main::admin-credix-layout>
    @section('title',__('menus'))
    @section('header-description',__('in this window you can see all :title and create new one',['title'=>__('menus')]))

    @section('formRoute' ,route('admin.appearance.menus.store'))

    @can('menu-edit')
        @section('form')
            <div class="my-3">
                <x-main::input.label for="title" value="{{__('title')}}"/>
                <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title')"/>
                <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
            </div>
        @endsection
    @endcanany

    @section('index')

        <x-main::box>
            <div class="flex justify-end items-center mb-6">
                <x-main::search/>
            </div>
            <x-main::table :header="['id'=>'#','title'=>'title','label'=>'label',]">
                @if($menus->count())
                    @foreach($menus as $key=>$menu)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$menus->firstItem() + $key}}</td>
                            <td class="p-3">{{$menu->title}}</td>
                            <td class="p-3">{{$menu->label}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('menu-edit')
                                        <x-main::link.edit :route="route('admin.appearance.menus.edit' , $menu)" title="{{$menu->name}}"/>
                                        <x-main::link.sub :route="route('admin.appearance.menus.items.index' , $menu)" title="{{$menu->name}}"/>
                                    @endcan

                                    @can('menu-edit')
                                        <x-main::link.delete :route="route('admin.appearance.menus.destroy' , $menu)" title="{{$menu->name}}"/>
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
                @if($menus?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$menus->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>

    @endsection

</x-main::admin-credix-layout>

