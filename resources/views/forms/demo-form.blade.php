@php($random = rand(100, 999))

<div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 mb-6">
        <div>
            <x-input.label for="name" :value="__('name and lastname')"/>
            <x-input.text id="name" class="block w-full" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="{{__('full name')}}"/>
            <x-input.error :messages="$errors->get('name')" class="mt-2"/>

        </div>
        <div>
            <x-input.label for="company" :value="__('company name')"/>
            <x-input.text id="company" class="block w-full" type="text" name="company" :value="old('company')" required autocomplete="organization" placeholder="{{__('company name')}}"/>
            <x-input.error :messages="$errors->get('company')" class="mt-2"/>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 mb-6">
        <div>
            <x-input.label for="email" :value="__('email')"/>
            <x-input.text id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="email" inputmode="email" placeholder="example@example.com"/>
            <x-input.error :messages="$errors->get('email')" class="mt-2"/>

        </div>
        <div>
            <x-input.label for="phone" :value="__('phone')"/>
            <x-input.text id="phone" class="block w-full" type="text" name="phone" :value="old('phone')" required autocomplete="tel" inputmode="tel" placeholder="021XXXXXXXX"/>
            <x-input.error :messages="$errors->get('phone')" class="mt-2"/>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 mb-6">
        <div>
            <x-input.label for="activities" :value="__('activities of company')"/>
            <x-input.text id="activities" class="block w-full" type="text" name="activities" :value="old('activities')" placeholder="{{__('activities of company')}}"/>
            <x-input.error :messages="$errors->get('activities')" class="mt-2"/>

        </div>
    </div>

    <fieldset class="mb-6 border border-slate-200 rounded p-3" id="form-demo-software">
        <legend  class="h4" >
            {{__('systems and software')}}
        </legend>
        <x-input.error :messages="$errors->get('software')" class="mt-2"/>
        <x-input.error :messages="$errors->get('software.*')" class="mt-2"/>
        <div>
            <ul class="accordion-list space-y-3" x-data="{ selected : null }">
                <li class="">
                    <div :class="selected === 0 ? 'border-b' : ''">
                        <button type="button" role="button" title="سیستم ساز"  class="w-full justify-between flex items-center gap-6"
                                @click="selected = selected === 0 ? null :0"
                                :aria-expanded="selected === 0" :aria-seleced="selected === 0" aria-controls="aria-accordion-{{ $random }}-0" >
                                <span class="p px-1 py-2 text-sm" itemprop="name">
                                    سیستم ساز / BPMS
                                 </span>
                            <svg class="w-4 h-4 duration-200 ease-out" :class="{ 'rotate-180': selected === 0 }" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>

                        </button>
                    </div>
                    <div class="overflow-hidden transition-all max-h-0 duration-700" id="aria-accordion-{{ $random }}-0" x-ref="container0"  x-bind:style="selected === 0 ? 'max-height: ' + $refs.container0.scrollHeight + 'px' : ''" >
                        <div class="p-3" itemprop="text">
                            <ul class="sm:columns-2 space-y-1">
                                <li class="flex items-center gap-3">
                                    <x-input.checkbox class="softwareInput" id="software-system" name="software[]" value="سیستم ساز"/>
                                    <x-input.label for="software-system" value="سیستم ساز" class="!mb-0 !text-sm "/>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @foreach(\Modules\System\Models\Solution::query()->select('title' ,'id','order')->get()->sortBy('order') as $solution)
                 @php($randomSol=rand(10000,99999))
                <li class="">
                   <div :class="selected === {{ $loop->index + 1 }} ? 'border-b' : ''">
                             <button type="button" role="button" title="{{__('software of :title',['title'=>$solution->title])}}"  class="w-full justify-between flex items-center gap-6"
                                     @click="selected = selected === {{ $loop->index + 1 }} ? null : {{ $loop->index + 1 }}"
                                     :aria-expanded="selected === {{ $loop->index + 1 }}" :aria-seleced="selected === {{ $loop->index + 1 }}" aria-controls="aria-accordion-{{ $random }}-{{ $loop->index + 1 }}" >
                                 <span class="p px-1 py-2 text-sm" itemprop="name">
                                 {{ $solution->title }}
                                  </span>
                                 <svg class="w-4 h-4 duration-200 ease-out" :class="{ 'rotate-180': selected === {{ $loop->index + 1 }} }" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                             </button>
                         </div>
                   <div class="overflow-hidden transition-all max-h-0 duration-700" id="aria-accordion-{{ $random }}-{{ $loop->index + 1 }}" x-ref='container{{ $loop->index + 1 }}'  x-bind:style="selected === {{ $loop->index + 1 }} ? 'max-height: ' + $refs.container{{ $loop->index + 1 }}.scrollHeight + 'px' : ''" >
                       <div class="p-3" itemprop="text">
                          <ul class="grid gap-1 sm:grid-cols-2">
                              <li class="flex items-center gap-3 sm:col-span-2">
                                  <x-input.checkbox data-parent="{{$randomSol}}" class="softwareInput solution-selection" id="software-{{$loop->index}}" name="software[]" value="{{$solution->title}}"/>
                                  <x-input.label for="software-{{$loop->index}}" value="{{$solution->title}}" class="!mb-0 !font-bold !text-base"/>
                              </li>
                             @foreach($solution->software()->select('title' ,'id')->get() as $software)
                                 <li class="flex items-center gap-3">
                                     <x-input.checkbox data-parent-id="{{$randomSol}}" class="softwareInput software-selection" id="software-{{$loop->parent->index}}-{{$loop->index}}" name="software[]" value="{{$software->title}}" data-child=""/>
                                     <x-input.label for="software-{{$loop->parent->index}}-{{$loop->index}}" value="{{$software->title}}" class="!mb-0 !text-sm"/>
                                 </li>
                             @endforeach
                          </ul>
                       </div>
                   </div>
                </li>
                @endforeach
            </ul>
        </div>
    </fieldset>
    <div id="selected_software" class="my-6"></div>
</div>
