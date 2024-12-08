<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('orders')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('orders')]))

    @section('hero-start-section')
        @can('order-create')
            <x-main::link.header :title="__('new :title',['title' =>__('order')])"
                                 :href="route('admin.sell.orders.create')"/>
        @endcan
    @endsection
    @section('hero-end-section')
        <x-main::search/>
    @endsection

    @section('main')

        <x-main::box>
            <x-main::table
                :header="['id'=>'#','order_number'=>'order','status'=>'status','user'=>'user','created_at'=>'created at',]">
                @if($orders->count())
                    @foreach($orders as $key=>$order)
                        @php
                            $class=match ($order->status){
                                'prepay'=>'bg-yellow-300 text-yellow-900',
                                'paid'=>'bg-green-300 text-green-900',
                                'failed'=>'bg-orange-300 text-orange-900',
                                'offline paid'=>'bg-teal-300 text-teal-900',
                                'returned'=>'bg-red-300 text-red-900',
                                default=>''
                            };
                            $class= $class .' '. 'px-2 py-1 rounded text-sm font-bold'
                        @endphp
                        <tr class="group hover:bg-slate-100 ">
                            <td class="p-3">
                                {{$orders->firstItem() + $key}}
                            </td>
                            <td class="p-3">
                               <span class="{{$class}}">
                                    {{$order->order_number}}
                               </span>
                            </td>
                            <td class="p-3">
                               <span class="{{$class}}">
                                    {{__($order->status)}}
                               </span>
                            </td>
                            <td class="p-3">
                                {{$order->user->name}}
                            </td>
                            <td class="p-3">
                                {{$order->created_at}}
                            </td>

                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    <x-main::link.show :route="route('admin.sell.orders.show' , $order)"
                                                       title="{{$order->order_number}}" :blank="false"/>
                                    @can('order-edit')
                                        <x-main::link.edit :route="route('admin.sell.orders.edit' , $order)"
                                                           title="{{$order->order_number}}"/>
                                    @endcan
                                    @can('order-delete')
                                        <x-main::link.delete :route="route('admin.sell.orders.destroy' , $order)"
                                                             title="{{$order->order_number}}"/>
                                    @endcan

                                    @can('order-change')
                                        <x-main::link.edit :route="route('admin.sell.orders.change' , $order)"
                                                           title="{{$order->order_number}}"/>
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
                @if($orders?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$orders->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

