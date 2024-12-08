<x-client-layout>
    <div id="page-content" class="about-page">
        <main class="">
            <section class="mb-12 content-center min-h-screen-1/2 py-24 inner-container">
                <h1 class="text-center">
                    {{__('checkout')}}
                </h1>
                <p class="text-center">
                    {{__('please do not refresh this page')}}.
                </p>
                <form action="{{route('payment.pay')}}" method="POST">
                    @csrf
                    <div class="grid gap-6 lg:grid-cols-2 items-start">
                        <div>
                            <div class="mb-6">
                                <x-input.label for="name" :value="__('name')"/>
                                <x-input.text class="block w-full" type="text" id="name" name="name"
                                              :value="old('name')" requered="required"/>
                                <x-main::input.error :messages="$errors->get('name')" class="mt-2"/>
                            </div>
                            <div class="mb-6">
                                <x-input.label for="email" :value="__('email')"/>
                                <x-input.text class="block w-full" type="email" id="email" name="email"
                                              :value="old('email')" requered="required"/>
                                <x-main::input.error :messages="$errors->get('email')" class="mt-2"/>
                            </div>
                            <div class="mb-6">
                                <x-input.label for="phone" :value="__('phone')"/>
                                <x-input.text class="block w-full" type="phone" id="phone" name="phone"
                                              :value="old('phone')" requered="required"/>
                                <x-main::input.error :messages="$errors->get('phone')" class="mt-2"/>
                            </div>
                            <div class="mb-6">
                                <x-input.label for="zip_code" :value="__('zip code')"/>
                                <x-input.text class="block w-full" type="text" id="zip_code" name="zip_code"
                                              :value="old('zip code')" requered="required"/>
                                <x-main::input.error :messages="$errors->get('zip_code')" class="mt-2"/>
                            </div>
                            <div class="mb-6">
                              <div class="grid gap-6 md:grid-cols-2">
                                  <div>
                                      <x-input.label for="province" :value="__('province')" />
                                      <x-input.text class="block w-full" type="text" id="province" name="address[province]"  requered="required" />

                                      <x-main::input.error :messages="$errors->get('address.province')" class="mt-2"/>
                                  </div>
                                  <div>
                                      <x-input.label for="city" :value="__('city')" />
                                      <x-input.text class="block w-full" type="text" id="city" name="address[city]"  requered="required" />

                                      <x-main::input.error :messages="$errors->get('address.city')" class="mt-2"/>
                                  </div>
                                  <div class="col-span-2">
                                      <x-input.label for="address" :value="__('address')" />
                                      <x-input.textarea class="block w-full" type="text" id="address" name="address[street]"  requered="required">
                                          {{old('address.street')}}
                                      </x-input.textarea>
                                      <x-main::input.error :messages="$errors->get('address.street')" class="mt-2"/>
                                  </div>

                              </div>
                            </div>
                            <div class="mb-6">
                                <div id="map"></div>
                            </div>
                            <div>
                                <input type="hidden" id="latitude" name="geo[latitude]">
                                <input type="hidden" id="longitude" name="geo[longitude]">
                            </div>
                        </div>
                        <div class="border border-slate-200 rounded-lg p-6">
                            <div class="p-3 rounded-lg flex items-center gap-3">
                               <span class="text-xl font-bold">
                                    {{__('payout')}}
                               </span>
                                <span>
                                   {{number_format($order->price)}}
                               </span>
                            </div>
                            <div class="p-3 rounded-lg flex items-start gap-3">
                               <span class="text-xl font-bold">
                                   {{__('orders')}}
                                </span>
                                <ul>
                                    @foreach($order->products as $product)
                                        <li class="text-sm">{{$product->title}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <x-button.primary class="">
                                {{__('pay')}}
                            </x-button.primary>
                        </div>
                    </div>
                </form>

            </section>
        </main>
    </div>

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
            document.addEventListener("DOMContentLoaded", function () {
                // Initialize the map and set its view to Tehran
                const map = L.map('map').setView([35.6892, 51.3890], 15);

                // Add a tile layer (OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Add a marker when the user clicks on the map
                let marker;
                map.on('click', function (e) {
                    const { lat, lng } = e.latlng;

                    // Add or move the marker
                    if (marker) {
                        marker.setLatLng([lat, lng]);
                    } else {
                        marker = L.marker([lat, lng]).addTo(map);
                    }

                    // Store latitude and longitude in hidden input fields
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                });
            });
        </script>

    @endpush
</x-client-layout>
