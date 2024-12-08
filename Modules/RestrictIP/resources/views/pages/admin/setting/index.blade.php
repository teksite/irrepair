<x-main::admin-layout>
    @section('title',__('restrict ips'))
    @section('header-description',__('in this window you can see all ips to allow or block them'))

     <setion>
            <div class="mb-6">
                <span class="font-bold text-xl">
                {{__('restrict mode')}} :
            </span>
                <span>
                 {{config('restrictip.restrict_mode')}}
             </span>
            </div>
             <p class="mb-6">
                 @if(config('restrictip.restrict_mode') ==='blacklist')
                     {{__('in this condition only black list ips are blocked')}}
                 @elseif(config('restrictip.restrict_mode') ==='whitelist')
                     {{__('in this condition all ips are blocked but white list')}}
                 @endif
             </p>
             <p class="mb-6">
                 {{__('to add or remove an item from the list, call a admin')}}
             </p>
         <div class="grid gap-6 md:grid-cols-2">
             <x-main::box>
                 <h3 class="text-center mb-6">
                     {{__('black list')}}
                 </h3>
                 <x-main::table :header="['#','ips']">
                     @if(config('restrcitedip.black_ip'))
                         @foreach(config('restrcitedip.black_ip') ?? [] as $ip)
                             <tr class="group hover:bg-slate-100">
                                 <td class="p-3">{{$loop->iteration}}</td>
                                 <td class="p-3">
                                     @if(is_string($ip))
                                         {{$ip}}
                                     @endif
                                     @if(is_array($ip))
                                         {{implode(' - ' ,$ip)}}
                                     @endif
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

                 </x-main::table>
             </x-main::box>
             <x-main::box>
                 <h3 class="text-center mb-6">
                     {{__('white list')}}
                 </h3>
                 <x-main::table :header="['#','ips']">
                     @if(config('restrcitedip.white_ip'))
                         @foreach(config('restrcitedip.white_ip') ?? [] as $ip)
                             <tr class="group hover:bg-slate-100">
                                 <td class="p-3">{{$loop->iteration}}</td>
                                 <td class="p-3">
                                     @if(is_string($ip))
                                         {{$ip}}
                                     @endif
                                     @if(is_array($ip))
                                         {{implode(' - ' ,$ip)}}
                                     @endif
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

                 </x-main::table>
             </x-main::box>
         </div>
     </setion>


</x-main::admin-layout>

