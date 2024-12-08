@props(['open'=>true ,'banners'=>[]])
<x-main::accordion.single :title="__('banner')" :open="$open">
    <section>
        @php
            $oldBanner=old('banners') ?? $banners['value'] ?? [];
        @endphp
        <div id="banner-item">
           @if(count($oldBanner))
                @foreach($oldBanner as $banner)
                    <fieldset class="fieldset" id="bannerItem-{{$loop->index}}">
                        <legend>
                            <span class="px-3">{{'#'.$loop->iteration}}</span>
                        </legend>
                    <div class="bannerItem"  >
                        <div class=" mb-3 flex justify-between items-center gap-6" >
                            <div class="w-full md:w-1/2">
                                <x-main::input.label :value="__('banner')" for="banners-{{$loop->index}}-image"/>
                                <x-main::input.text name="extra[banners][{{$loop->index}}][image]" type="text" id="banners-{{$loop->index}}-image" class="block w-full"  :value="$banner['image'] ?? ''" dir="ltr"/>
                            </div>
                            <button type="button" class="text-red-900 deleteItemBtn" data-target="bannerItem-{{$loop->index}}">
                                &times;
                            </button>
                        </div>
                        <div class="w-full">
                            <x-main::input.label :value="__('background')" for="banners-{{$loop->index}}-background"/>
                            <x-main::input.text id="banners-{{$loop->index}}-background" class="block w-full" name="extra[banners][{{$loop->index}}][background]" :value="$banner['background'] ?? ''"  dir="ltr"/>
                        </div>
                        <div class="w-full">
                            <x-main::input.label :value="__('title')" for="banners-{{$loop->index}}-title"/>
                            <x-main::input.text id="banners-{{$loop->index}}-title" class="block w-full" name="extra[banners][{{$loop->index}}][title]" :value="$banner['title'] ?? ''" />
                        </div>
                        <div class="w-full">
                            <x-main::input.label :value="__('description')" for="banners-{{$loop->index}}-description"/>
                            <x-main::input.textarea id="banners-{{$loop->index}}-description" class="block w-full"  name="extra[banners][{{$loop->index}}][description]">{{$banner['description'] ?? ''}}</x-main::input.textarea>
                        </div>
                        <div class="grid gap-6 md:grid-cols-2 mt-6">
                            <div class="w-full">
                                <x-main::input.label value="{{__('link title')}} #1" for="banners-{{$loop->index}}-link1_title"/>
                                <x-main::input.text id="banners-{{$loop->index}}-link1_title" class="block w-full" type="text"  name="extra[banners][{{$loop->index}}][link1_title]" :value="$banner['link1_title'] ?? ''"/>
                            </div>
                            <div class="w-full">
                                <x-main::input.label value="{{__('link url')}} #1" for="banners-{{$loop->index}}-link1_url"/>
                                <x-main::input.text id="banners-{{$loop->index}}-link1_url" class="block w-full" type="text"  name="extra[banners][{{$loop->index}}][link1_url]" :value="$banner['link1_url'] ?? ''"  dir="ltr"/>

                            </div>
                            <div class="w-full">
                                <x-main::input.label value="{{__('link title')}} #2" for="banners-{{$loop->index}}-link2_title"/>
                                <x-main::input.text id="banners-{{$loop->index}}-link2_title" class="block w-full" type="text"  name="extra[banners][{{$loop->index}}][link2_title]" :value="$banner['link2_title'] ?? ''"/>
                            </div>
                            <div class="w-full">
                                <x-main::input.label value="{{__('link url')}} #2" for="banners-{{$loop->index}}-link2_url"/>
                                <x-main::input.text id="banners-{{$loop->index}}-link2_url" class="block w-full" type="text"  name="extra[banners][{{$loop->index}}][link2_url]" :value="$banner['link2_url'] ?? ''"  dir="ltr"/>

                            </div>
                        </div>
                        <x-main::input.error :messages="$errors->get('banners.'.$loop->index .'background')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('banners.'.$loop->index .'image')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('banners.'.$loop->index .'title')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('banners.'.$loop->index .'description')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('banners.'.$loop->index .'link1_title')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('banners.'.$loop->index .'link1_url')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('banners.'.$loop->index .'link2_title')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('banners.'.$loop->index .'link2_url')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('banners.'.$loop->index)" class="my-2"/>
                    </div>
                    </fieldset>
                @endforeach
            @endif
            <div x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ background: '' ,image:'',title:'' , desc:'' ,link1Tile:'',link1Url:'',link2Tile:'',link2Url:''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.bannerItem').length}" x-for="(field, index) in fields" :key="index">
                        <fieldset class="border border-gray-200 p-3 mb-6 bg-slate-50">
                            <legend>
                                <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                            </legend>
                            <div class="bannerItem" x-bind:id="`bannerItem-${index + lngth + 1}`">
                                <div class="my-3 flex justify-between items-center gap-6">
                                    <div class="w-full md:w-1/2">
                                        <label x-text:="`{{__('image url')}}`" x-bind:for="`banners[${index + lngth + 1}][image]`"
                                               class="block font-medium text-xs text-gray-700 mb-2">{{__('image url')}}</label>
                                        <x-main::input.text x-bind:id="`banners[${index + lngth + 1}][image]`" class="block w-full" x-model="image.txt1" type="text" x-bind:name="`extra[banners][${index + lngth + 1}][image]`" dir="ltr"/>
                                    </div>
                                    <div>
                                        <button type="button" class="text-red-900" @click="removeField(index)">
                                            &times;
                                        </button>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <x-main::input.label value="{{__('background')}}" x-bind:for="`banners[${index + lngth + 1}][background]`"/>
                                    <x-main::input.text x-bind:id="`banners[${index + lngth + 1}][background]`" class="block w-full" x-model="field.background" type="text"  x-bind:name="`extra[banners][${index + lngth + 1}][background]`" dir="ltr"/>
                                </div>
                                <div class="w-full">
                                    <x-main::input.label value="{{__('title')}}" x-bind:for="`banners[${index + lngth + 1}][title]`"/>
                                    <x-main::input.text x-bind:id="`banners[${index + lngth + 1}][title]`" class="block w-full" x-model="field.title" type="text"  x-bind:name="`extra[banners][${index + lngth + 1}][title]`" />
                                </div>
                                <div class="w-full">
                                    <x-main::input.label value="{{__('description')}}" x-bind:for="`banners[${index + lngth + 1}][description]`"/>
                                    <x-main::input.textarea x-bind:id="`banners[${index + lngth + 1}][description]`" class="block w-full" x-model="field.desc" type="text"  x-bind:name="`extra[banners][${index + lngth + 1}][description]`"></x-main::input.textarea>
                                </div>
                                <div class="grid gap-12 md:grid-cols-2">
                                    <div class="w-full">
                                        <x-main::input.label value="{{__('link title')}} #1" x-bind:for="`banners[${index + lngth + 1}][link1_title]`"/>
                                        <x-main::input.text x-bind:id="`banners[${index + lngth + 1}][link1_title]`" class="block w-full" x-model="field.link1Tile" type="text"  x-bind:name="`extra[banners][${index + lngth + 1}][link1_title]`" />
                                    </div>
                                    <div class="w-full">
                                        <x-main::input.label value="{{__('link url')}} #1" x-bind:for="`banners[${index + lngth + 1}][link1_url]`"/>
                                        <x-main::input.text x-bind:id="`banners[${index + lngth + 1}][link1_url]`" class="block w-full" x-model="field.link1Url" type="text"  x-bind:name="`extra[banners][${index + lngth + 1}][link1_url]`"  dir="ltr" />
                                    </div>
                                    <div class="w-full">
                                        <x-main::input.label value="{{__('link title')}} #2" x-bind:for="`banners[${index + lngth + 1}][link2_title]`"/>
                                        <x-main::input.text x-bind:id="`banners[${index + lngth + 1}][link2_title]`" class="block w-full" x-model="field.link2Tile" type="text"  x-bind:name="`extra[banners][${index + lngth + 1}][link2_title]`" />
                                    </div>
                                    <div class="w-full">
                                        <x-main::input.label value="{{__('link url')}} #2" x-bind:for="`banners[${index + lngth + 1}][link2_url]`"/>
                                        <x-main::input.text x-bind:id="`banners[${index + lngth + 1}][link2_url]`" class="block w-full" x-model="field.link2Url" type="text"  x-bind:name="`extra[banners][${index + lngth + 1}][link2_url]`"  dir="ltr" />
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add banner')}}" id="addBanner" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>

                    </div>
                </div>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('banners')" class="mt-2"/>

    </section>
</x-main::accordion.single>
