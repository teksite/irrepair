<x-main::admin-list-layout>
        @section('title' , __(':title list',['title'=>__('products')]))
        @section('header-description' , __("in this window you can see all :title", ['title'=>__('products')]))

        @section('hero-start-section')
            @can('product-create')
                <x-main::link.header :title="__('new :title',['title' =>__('product')])" :href="route('admin.shop.products.create')"/>
            @endcan
        @endsection
        @section('hero-end-section')
            <x-main::search/>
        @endsection

    @section('main')

        <x-main::box>
            <x-main::table :header="['id'=>'#','title'=>'title','description',]">
                @if($products->count())
                    @foreach($products as $key=>$product)
                        <tr class="group hover:bg-slate-100 ">
                            <td class="p-3">{{$products->firstItem() + $key}}</td>
                            <td class="p-3">{{$product->title}}</td>
                            <td class="p-3">{{$product->description}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('product-edit')
                                        <x-main::link.show :route="route('shop.products.show' , $product)" title="{{$product->title}}"/>
                                    @endcan
                                    @can('product-edit')
                                        <x-main::link.edit :route="route('admin.shop.products.edit' , $product)" title="{{$product->title}}"/>
                                    @endcan

                                    @can('product-delete')
                                        <x-main::link.delete :route="route('admin.shop.products.destroy' , $product)" title="{{$product->title}}"/>
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
                @if($products?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$products->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

