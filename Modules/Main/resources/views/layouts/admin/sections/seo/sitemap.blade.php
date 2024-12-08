@php
    if(isset($instance) && $instance && $instance->seo){
        $sitemap=$instance->seo->sitemap;
    }
@endphp
<section>
    <fieldset class="fieldset">
        <legend>
            <h3 class="px-3 py-2 bg-white">{{__('site map')}}</h3>
        </legend>
        <div>
    <div class="flex items-center gap-3 mb-6">
        <x-main::input.label for="sitemap_priority" :value="__('priority')" class="w-16"/>
        <x-main::input.text name="seo[sitemap][priority]" type="number" min="0" max="1" step="0.1" id="sitemap_priority" :value="old('seo.sitemap.priority') ?? $sitemap['priority'] ?? 0.5"/>
    </div>
    <div class="flex items-center gap-3 mb-6">
        <x-main::input.label for="sitemap_change" :value="__('frequently change')" class="w-16"/>
        <x-main::input.select name="seo[sitemap][changeFrequently]" type="number" min="0" max="1" step="0.1" id="sitemap_change">
            <option value="yearly" {{old('seo.sitemap.changeFrequently' === 'yearly') || (isset($sitemap['changeFrequently']) && $sitemap['changeFrequently'] =='yearly') ? 'selected':''}}>{{__('yearly')}}</option>
            <option value="hourly" {{old('seo.sitemap.changeFrequently' === 'hourly') || (isset($sitemap['changeFrequently']) && $sitemap['changeFrequently'] =='hourly') ? 'selected':''}}>{{__('hourly')}}</option>
            <option value="daily" {{old('seo.sitemap.changeFrequently' === 'daily') || (isset($sitemap['changeFrequently']) && $sitemap['changeFrequently'] =='daily') ? 'selected':''}}>{{__('daily')}}</option>
            <option value="weekly" {{old('seo.sitemap.changeFrequently' === 'weekly') || (isset($sitemap['changeFrequently']) && $sitemap['changeFrequently'] =='weekly') ? 'selected':''}}>{{__('weekly')}}</option>
            <option value="monthly" {{old('seo.sitemap.changeFrequently' === 'monthly') || (isset($sitemap['changeFrequently']) && $sitemap['changeFrequently'] =='monthly') ? 'selected':''}}>{{__('monthly')}}</option>
            <option value="never" {{old('seo.sitemap.changeFrequently' === 'never') || (isset($sitemap['changeFrequently']) && $sitemap['changeFrequently'] =='never') ? 'selected':''}}>{{__('never')}}</option>
            <option value="never" {{old('seo.sitemap.changeFrequently' === 'always') || (isset($sitemap['changeFrequently']) && $sitemap['changeFrequently'] =='always') ? 'selected':''}}>{{__('always')}}</option>
        </x-main::input.select>
    </div>

    {{--IMAGES--}}
    <section class="mb-6">
        <span class="block p h2 text-lg font-bold">{{__('image')}}</span>
        <p>{{__('you can insert some images to be added in sitemap')}}</p>
        @php
            $oldIVideos=old('seo.sitemap.images') ?? $sitemap['images'] ?? [];
        @endphp

        <div id="image-item">
            @if(count($oldIVideos))
                @foreach($oldIVideos as $image)
                    <div class="sitemap_imageItem" id="imageItem-{{$loop->index}}">
                        <div class="mb-3 flex justify-between items-center gap-6">
                            <div class="w-full md:w-1/2">
                                <span class="p">{{__('image')}} #{{$loop->index + 1}}</span>
                                <div class="flex items-center gap-3">

                                    <x-main::input.label :value="__('url') .'*'" for="sitemap-image-{{$loop->index}}-url"/>
                                    <x-main::input.text name="seo[sitemap][images][{{$loop->index}}][url]" type="text"
                                                        id="sitemap-image-{{$loop->index}}-url" class="block w-full"
                                                        :value="$image['url'] ?? ''"/>
                                </div>
                                <div class="flex items-center gap-3">
                                    <x-main::input.label :value="__('title')"
                                                         for="sitemap-image-{{$loop->index}}-title"/>
                                    <x-main::input.text name="seo[sitemap][images][{{$loop->index}}][title]" type="text"
                                                        id="sitemap-image-{{$loop->index}}-title" class="block w-full"
                                                        :value="$image['title'] ?? ''"/>

                                </div>
                                <div class="flex items-center gap-3">
                                    <x-main::input.label :value="__('caption')"
                                                         for="sitemap-image-{{$loop->index}}-caption"/>
                                    <x-main::input.text name="seo[sitemap][images][{{$loop->index}}][caption]" type="text"
                                                        id="sitemap-image-{{$loop->index}}-caption" class="block w-full"
                                                        :value="$image['caption'] ?? ''"/>
                                </div>
                                <div class="flex items-center gap-3">

                                    <x-main::input.label :value="__('geo location')"
                                                         for="sitemap-image-{{$loop->index}}-geo_location"/>
                                    <x-main::input.text name="seo[sitemap][images][{{$loop->index}}][geo_location]"
                                                        type="text" id="sitemap-image-{{$loop->index}}-geo_location"
                                                        class="block w-full" :value="$image['geo_location'] ?? ''"/>
                                </div>
                            </div>
                            <button type="button" class="text-red-900 deleteItemBtn"
                                    target="imageItem-{{$loop->index}}">
                                &times;
                            </button>
                        </div>

                        <x-main::input.error :messages="$errors->get('seo.sitemap.images')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.images'.$loop->index)" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.images'.$loop->index.'title')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.images'.$loop->index.'url')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.images'.$loop->index.'cover')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.images'.$loop->index.'description')" class="my-2"/>
                    </div>
                @endforeach
            @endif
            <div
                x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: '' ,  txt2: '',  txt3: '', txt4: ''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.sitemap_imageItem').length}"
                              x-for="(field, index) in fields" :key="index">
                        <div class="sitemap_imageItem" x-bind:id="`imageItem-${index + lngth + 1}`">
                            <div class="my-3 flex justify-between items-center gap-6">
                                <div class="w-full md:w-1/2">
                                    <span x-text="`#${index + lngth + 1}`"> </span>
                                    <label x-text:="`{{__('image')}}`"
                                           class="block font-medium text-xs text-gray-700 mb-2">
                                        {{__('new :title',['title'=>__('image')])}}
                                    </label>
                                    <div class="flex items-center gap-3">
                                        <label x-text:="`{{__('url')}}*`"
                                               x-bind:for="`sitemap-images-[${index + lngth + 1}]-url`"
                                               class="block font-medium text-xs text-gray-700 mb-2">
                                            {{__('url')}}*
                                        </label>
                                        <x-main::input.text x-bind:id="`sitemap-images-[${index + lngth + 1}]-url`"
                                                            class="block w-full" x-model="field.txt1" type="text"
                                                            x-bind:name="`seo[sitemap][images][${index + lngth + 1}][url]`"/>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <label x-text:="`{{__('title')}}`"
                                               x-bind:for="`sitemap-images-[${index + lngth + 1}]-title`"
                                               class="block font-medium text-xs text-gray-700 mb-2">
                                            {{__('title')}}*
                                        </label>
                                        <x-main::input.text x-bind:id="`sitemap-images-[${index + lngth + 1}]-title`"
                                                            class="block w-full" x-model="field.txt2" type="text"
                                                            x-bind:name="`seo[sitemap][images][${index + lngth + 1}][title]`"/>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <label x-text:="`{{__('caption')}}`"
                                               x-bind:for="`sitemap-images-[${index + lngth + 1}]-caption`"
                                               class="block font-medium text-xs text-gray-700 mb-2">
                                            {{__('caption')}}
                                        </label>
                                        <x-main::input.text x-bind:id="`sitemap-images-[${index + lngth + 1}]-caption`"
                                                            class="block w-full" x-model="field.txt3" type="text"
                                                            x-bind:name="`seo[sitemap][images][${index + lngth + 1}][caption]`"/>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <label x-text:="`{{__('geo location')}}`"
                                               x-bind:for="`sitemap-images-[${index + lngth + 1}]-geo_location`"
                                               class="block font-medium text-xs text-gray-700 mb-2">
                                            {{__('geo_location')}}
                                        </label>
                                        <x-main::input.text
                                            x-bind:id="`sitemap-images-[${index + lngth + 1}]-geo_location`"
                                            class="block w-full" x-model="field.txt4" type="text"
                                            x-bind:name="`seo[sitemap][images][${index + lngth + 1}][geo_location]`"/>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="text-red-900"
                                            @click="removeField(index)">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add question')}}"
                                                id="addQuestion" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>

                    </div>
                </div>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('seo.sitemap.images')" class="mt-2"/>
        <x-main::input.error :messages="$errors->get('seo.sitemap.images.*')" class="mt-2"/>

    </section>

    {{--  VIDEO   --}}
    <section class="mb-6">
        <span class="block p h2 text-lg font-bold">{{__('video')}}</span>
        <p>{{__('you can insert some videos to be added in sitemap')}}</p>
        @php
            $oldIVideos=old('seo.sitemap.videos') ?? $sitemap['videos'] ?? [];
        @endphp

        <div id="video-item">
            @if(count($oldIVideos))
                @foreach($oldIVideos as $video)
                    <div class="sitemap_videoItem" id="videoItem-{{$loop->index}}">
                        <div class="mb-3 flex justify-between items-center gap-6">
                            <div class="w-full md:w-1/2">
                                <span class="p">{{__('video')}} #{{$loop->index + 1}}</span>
                                <div class="flex items-center gap-3">

                                    <x-main::input.label :value="__('url') .'*'" for="sitemap-video-{{$loop->index}}-url"/>
                                    <x-main::input.text name="seo[sitemap][videos][{{$loop->index}}][url]" type="text"
                                                        id="sitemap-video-{{$loop->index}}-url" class="block w-full"
                                                        :value="$video['url'] ?? ''"/>
                                </div>
                                <div class="flex items-center gap-3">
                                    <x-main::input.label :value="__('title') .'*'"
                                                         for="sitemap-video-{{$loop->index}}-title"/>
                                    <x-main::input.text name="seo[sitemap][videos][{{$loop->index}}][title]" type="text"
                                                        id="sitemap-video-{{$loop->index}}-title" class="block w-full"
                                                        :value="$video['title'] ?? ''"/>

                                </div>
                                <div class="flex items-center gap-3">
                                    <x-main::input.label :value="__('cover') .'*'"
                                                         for="sitemap-video-{{$loop->index}}-cover"/>
                                    <x-main::input.text name="seo[sitemap][videos][{{$loop->index}}][cover]" type="text"
                                                        id="sitemap-video-{{$loop->index}}-cover" class="block w-full"
                                                        :value="$video['cover'] ?? ''"/>
                                </div>
                                <div class="flex items-center gap-3">

                                    <x-main::input.label :value="__('description') .'*'"
                                                         for="sitemap-video-{{$loop->index}}-description"/>
                                    <x-main::input.text name="seo[sitemap][videos][{{$loop->index}}][description]"
                                                        type="text" id="sitemap-video-{{$loop->index}}-description"
                                                        class="block w-full" :value="$video['description'] ?? ''"/>
                                </div>
                            </div>
                            <button type="button" class="text-red-900 deleteItemBtn"
                                    target="videoItem-{{$loop->index}}">
                                &times;
                            </button>
                        </div>

                        <x-main::input.error :messages="$errors->get('seo.sitemap.videos')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.videos'.$loop->index)" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.videos'.$loop->index.'title')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.videos'.$loop->index.'url')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.videos'.$loop->index.'cover')" class="my-2"/>
                        <x-main::input.error :messages="$errors->get('seo.sitemap.videos'.$loop->index.'description')" class="my-2"/>
                    </div>
                @endforeach
            @endif
            <div
                x-data="function handler(){return { fields: [], addNewField(){this.fields.push({ txt1: '' ,  txt2: '',  txt3: '', txt4: ''});},removeField(index){ this.fields.splice(index, 1);}}}">
                <div>
                    <template x-data="{'lngth' : document.querySelectorAll('.sitemap_videoItem').length}"
                              x-for="(field, index) in fields" :key="index">
                        <div class="sitemap_videoItem" x-bind:id="`videoItem-${index + lngth + 1}`">
                            <div class="my-3 flex justify-between items-center gap-6">
                                <div class="w-full md:w-1/2">
                                    <span x-text="`#${index + lngth + 1}`"> </span>
                                    <label x-text:="`{{__('video')}}`"
                                           class="block font-medium text-xs text-gray-700 mb-2">
                                        {{__('new :title',['title'=>__('video')])}}
                                    </label>
                                    <div class="flex items-center gap-3">
                                        <label x-text:="`{{__('url')}}*`" x-bind:for="`sitemap-videos-[${index + lngth + 1}]-url`"
                                               class="block font-medium text-xs text-gray-700 mb-2">
                                            {{__('url')}}*
                                        </label>
                                        <x-main::input.text x-bind:id="`sitemap-videos-[${index + lngth + 1}]-url`"
                                                            class="block w-full" x-model="field.txt1" type="text"
                                                            x-bind:name="`seo[sitemap][videos][${index + lngth + 1}][url]`"/>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <label x-text:="`{{__('title')}}*`" x-bind:for="`sitemap-videos-[${index + lngth + 1}]-title`"
                                               class="block font-medium text-xs text-gray-700 mb-2">
                                            {{__('title')}}*
                                        </label>
                                        <x-main::input.text x-bind:id="`sitemap-videos-[${index + lngth + 1}]-title`"
                                                            class="block w-full" x-model="field.txt2" type="text"
                                                            x-bind:name="`seo[sitemap][videos][${index + lngth + 1}][title]`"/>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <label x-text:="`{{__('cover')}}`*" x-bind:for="`sitemap-videos-[${index + lngth + 1}]-cover`"
                                               class="block font-medium text-xs text-gray-700 mb-2">
                                            {{__('cover')}}*
                                        </label>
                                        <x-main::input.text x-bind:id="`sitemap-videos-[${index + lngth + 1}]-cover`"
                                                            class="block w-full" x-model="field.txt3" type="text"
                                                            x-bind:name="`seo[sitemap][videos][${index + lngth + 1}][cover]`"/>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <label x-text:="`{{__('description')}}`*"
                                               x-bind:for="`sitemap-videos-[${index + lngth + 1}]-description`"
                                               class="block font-medium text-xs text-gray-700 mb-2">
                                            {{__('description')}}*
                                        </label>
                                        <x-main::input.text
                                            x-bind:id="`sitemap-videos-[${index + lngth + 1}]-description`"
                                            class="block w-full" x-model="field.txt4" type="text"
                                            x-bind:name="`seo[sitemap][videos][${index + lngth + 1}][description]`"/>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="text-red-900"
                                            @click="removeField(index)">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="my-3">
                        <x-main::button.primary type="button" role="button" title="{{__('add question')}}" id="addQuestion" @click="addNewField()">
                            {{__('add')}}
                        </x-main::button.primary>

                    </div>
                </div>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('videos')" class="mt-2"/>

    </section>
        </div>
    </fieldset>
</section>
