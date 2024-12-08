<x-main::admin-list-layout>
    @section('title' , __('show :title',['title'=>__('order')]))
    @section('header-description' , __("in this window you can see details of :title", ['title'=>__('order')  . ' #' .$order->order_number ]))

    @section('hero-start-section')
        <x-main::link.header :href="route('admin.sell.orders.index')" :title="__('all :title',['title'=>__('orders')])" />
    @endsection
    @section('hero-end-section')
    @endsection

    @section('main')
        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <x-main::box class="mb-6">
                    <h3>
                        {{__('order')}}
                    </h3>
                    <hr class="my-3">
                    <x-main::table>
                        <tr>
                            <th class="p-3">
                                {{__('order')}}
                            </th>
                            <td class="p-3">
                                {{$order->order_number}}
                            </td>
                        </tr>
                        <tr>
                            <th class="p-3">
                                {{__('created at')}}
                            </th>
                            <td class="p-3">
                         <span dir="ltr">
                             {{$order->created_at}}
                         </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="p-3">
                                {{__('total price')}}
                            </th>
                            <td class="p-3">
                                {{number_format($order->price)}}
                            </td>
                        </tr>
                        <tr>
                            <th class="p-3">
                                {{__('status')}}
                            </th>
                            <td class="p-3">
                                {{__($order->status)}}
                            </td>
                        </tr>

                    </x-main::table>
                </x-main::box>
                @if($order?->payments)

                    <x-main::box class="mb-6">
                        <h3>
                            {{__('payment')}}
                        </h3>
                        <hr class="my-3">
                        <x-main::table>
                            <tr>
                                <th class="p-3">
                                    {{__('tracking code')}}
                                </th>
                                <td class="p-3">
                                    {{$order?->payments->tracking_code ?? '-'}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('created at')}}
                                </th>
                                <td class="p-3">
                             <span dir="ltr">
                                 {{$order?->payments->created_at}}
                             </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('total price')}}
                                </th>
                                <td class="p-3">
                                    {{number_format($order?->payments->price)}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('status')}}
                                </th>
                                <td class="p-3">
                                    {{$order?->payments->status ? __('paid') :__('failed')}}
                                </td>
                            </tr>
                        </x-main::table>
                    </x-main::box>
                @endif
                @if($order?->details)
                    <x-main::box class="mb-6">
                        <h3>
                            {{__('invoice')}}
                        </h3>
                        <hr class="my-3">
                        <x-main::table>
                            <tr>
                                <th class="p-3">
                                    {{__('name')}}
                                </th>
                                <td class="p-3">
                                    {{$order?->details->name ?? $order->user->name}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('phone')}}
                                </th>
                                <td class="p-3">
                             <span dir="ltr">
                                    {{$order?->details->phone ?? $order->user->phone}}
                             </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('email')}}
                                </th>
                                <td class="p-3">
                                    {{$order?->details->email ?? $order->user->email}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('address')}}
                                </th>
                                <td class="p-3">

                                    {{$order?->details->address?->map(fn ($value , $key)=> __($key) . ': ' . $value)->implode(', ')}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('zip code')}}
                                </th>
                                <td class="p-3">

                                    {{$order?->details->zip_code}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('status')}}
                                </th>
                                <td class="p-3">

                                    {{$order?->details->status}}
                                </td>
                            </tr>
                            <tr>
                                <th class="p-3">
                                    {{__('delivery')}}
                                </th>
                                <td class="p-3">

                                    {{$order?->details->delivery}}
                                </td>
                            </tr>
                            @if($order?->details->location)
                                <tr>
                                    <th class="p-3">
                                        {{__('location')}}
                                    </th>
                                    <td class="p-3">
                                        @php
                                            $latitude=$order?->details->location['latitude'];
                                            $longitude=$order?->details->location['longitude'];
                                            $googleMapsLink = "https://www.google.com/maps?q=$latitude,$longitude";
                                        @endphp
                                      <div class="flex flex-col md:flex-row items-center  gap-1 justify-between mb-6">
                                        <span class="min-w-fit w-fit">
                                              [ latitude: {{$order?->details->location['latitude']}} - longitude: {{$order?->details->location['longitude']}} ]
                                        </span>
                                          <a href="{{$googleMapsLink}}" title="google map" target="_blank"><i class="tkicon fill-none stroke-blue-600" data-icon="google-map"></i></a>

                                      </div>

                                        <div id="map"></div>

                                        @push('headerScripts')
                                            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
                                            <style>
                                                #map {
                                                    height: 400px; /* Set map height */
                                                    width: 100%;
                                                }
                                            </style>
                                        @endpush
                                        @push('footerScripts')
                                            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                                            <script>
                                                var latitude = {{ $latitude }};
                                                var longitude = {{ $longitude }};

                                                // Initialize the Leaflet map
                                                var map = L.map('map').setView([latitude, longitude], 16);

                                                // Add a Tile Layer
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    maxZoom: 19,
                                                    attribution: '© OpenStreetMap contributors'
                                                }).addTo(map);

                                                // Add a marker
                                                var marker = L.marker([latitude, longitude]).addTo(map);
                                                marker.bindPopup("Location").openPopup();
                                            </script>

                                        @endpush
                                    </td>
                                </tr>
                            @endif
                        </x-main::table>
                    </x-main::box>
                @endif
            </div>
            <x-main::box>
                <h3>{{__('products')}}</h3>
                <hr class="my-3">
                @if(count($order?->products))
                    <ul>
                        @foreach($order?->products ?? [] as $product)
                            <li class="flex items-center gap3">
                                <a href="{{$product->path()}}" class="font-bold text-sm min-w-fit w-fit">
                                    {{$product->title}}
                                </a>
                                <hr class="border-dashed w-full">
                                <div class="flex items-center gap-3 w-fit min-w-fit">
                                    <span>{{$product->pivot->type}}</span>
                                    <span>X{{$product->pivot->quantity}}</span>
                                    <span>{{number_format($product->pivot->price)}}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif


            </x-main::box>
        </div>
    @endsection

</x-main::admin-list-layout>

