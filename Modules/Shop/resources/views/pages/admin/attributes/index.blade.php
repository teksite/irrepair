<x-main::admin-credix-layout>
    @section('title',__('attributes'))
    @section('header-description',__('in this window you can see all :title and create new one',['title'=>__('attributes')]))

    @section('formRoute' ,route('admin.shop.attributes.store'))

    @can('product-edit')
        @section('form')
            <div class="my-3">
                <x-main::input.label for="title" value="{{__('title')}}"/>
                <x-main::input.text id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"/>
                <x-main::input.error :messages="$errors->get('title')" class="mt-2"/>
            </div>
        @endsection
    @endcanany

    @section('index')

        <x-main::box>
            <div class="flex justify-end items-center mb-6">
                <x-main::search/>
            </div>
            <x-main::table :header="['id'=>'#','title'=>'title',]">
                @if($attributes->count())
                    @foreach($attributes as $key=>$attribute)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$attributes->firstItem() + $key}}</td>
                            <td class="p-3">{{$attribute->title}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('product-edit')
                                        <x-main::link.sub :route="route('admin.shop.attributes.values.index' , $attribute)" title="{{$attribute->title}}"/>
                                        <x-main::link.edit :route="route('admin.shop.attributes.edit' , $attribute)" title="{{$attribute->title}}"/>
                                        <x-main::link.delete :route="route('admin.shop.attributes.destroy' , $attribute)" title="{{$attribute->title}}"/>
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
                @if($attributes?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$attributes->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>

    @endsection

</x-main::admin-credix-layout>

