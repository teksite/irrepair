<x-main::admin-credix-layout>
    @section('title',__('values') .' - '.$attribute->title  )
    @section('header-description',__('in this window you can see all :title and create new one',['title'=>__('values')]))

    @section('formRoute' ,route('admin.shop.attributes.values.store', $attribute))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.shop.attributes.index')" :title="__('all :title',['title'=>__('attributes')])" />
    @endsection
    @can('product-edit')
        @section('form')
            <div class="my-3">
                <x-main::input.label for="value" value="{{__('value')}}"/>
                <x-main::input.text id="value" class="block mt-1 w-full" type="text" name="value" :value="old('value')"/>
                <x-main::input.error :messages="$errors->get('value')" class="mt-2"/>
            </div>
        @endsection
    @endcanany

    @section('index')

        <x-main::box>
            <div class="flex justify-end items-center mb-6">
                <x-main::search/>
            </div>
            <x-main::table :header="['id'=>'#','title'=>'title',]">
                @if($values->count())
                    @foreach($values as $key=>$value)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$values->firstItem() + $key}}</td>
                            <td class="p-3">{{$value->value}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('product-edit')
                                        <x-main::link.sub :route="route('admin.shop.attributes.values.index' , [$attribute, $value])" title="{{$value->title}}"/>
                                        <x-main::link.edit :route="route('admin.shop.attributes.values.edit', [$attribute, $value])" title="{{$value->title}}"/>
                                        <x-main::link.delete :route="route('admin.shop.attributes.values.destroy' , [$attribute, $value])" title="{{$value->title}}"/>
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
                @if($values?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$values->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>

    @endsection

</x-main::admin-credix-layout>

