
<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="VideoObject" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="VideoObject" class="hidden"  type="hidden"/>

    <div id="schema-title-section">
            @foreach($schema['videos'] ?? [] as $video)
                @php($i=$loop->index)

                <fieldset class="fieldset videoItem" id="videoItem-{{$loop->index}}">
                    <legend>
                        <span class="px-3">#{{$loop->index + 1}}</span>
                    </legend>
                    <div>
                        <div class="mb-3 flex justify-between items-center gap-6">
                            <div class="w-full">
                                <x-main::input.label value="{{__('title')}}" for="title-{{$loop->index}}"/>
                                <x-main::input.text id="title-{{$loop->index}}" class="block w-full"
                                                    type="text" name="seo[schema][videos][{{$loop->index}}][title]"
                                                    maxlength="255" :value="$video['title'] ?? ''"/>
                                <x-main::input.error :messages="$errors->get('schema.videos.*.title')" class="mt-2"/>
                            </div>
                            <div>
                                <button type="button" class="text-red-900 deleteItemBtn" onclick="document.getElementById('videoItem-{{$loop->index}}').remove()">
                                    &times;
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-main::input.label for="description-{{$loop->index}}" value="{{__('description')}}"/>
                            <x-main::input.textarea id="description-{{$loop->index}}" class="block w-full"
                                                    name="seo[schema][videos][{{$loop->index}}][description]">{{$video['description'] ?? '' }}</x-main::input.textarea>
                            <x-main::input.error :messages="$errors->get('schema.videos.*.description')" class="mt-2"/>

                        </div>
                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            {{--uploadDate--}}
                            <div>
                                <x-main::input.label value="{{__('upload date')}}" for="uploadDate-{{$loop->index}}"/>
                                <x-main::input.date id="uploadDate-{{$loop->index}}" class="block w-full" maxlength="255" type="datetime-local" name="seo[schema][videos][{{$loop->index}}][uploadDate]" :value="$video['uploadDate'] ?? ''"/>
                            </div>
                            {{--regionsAllowed--}}
                            <div>
                                <x-main::input.label value="{{__('regions allowed')}}" for="regionsAllowed-{{$loop->index}}"/>
                                <x-main::input.select id="regionsAllowed-{{$loop->index}}" name="seo[schema][videos][{{$loop->index}}][regionsAllowed]"
                                                      class="block w-full">
                                    @foreach(config('global.area') as $key=>$value)
                                        <option value="{{$key}}" {{$video['regionsAllowed']==$key ? 'selected': ''}}> {{__($value)}} </option>
                                    @endforeach
                                </x-main::input.select>
                            </div>

                        </div>
                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label :value="__('content url')" for="contentUrl-{{$loop->index}}"/>
                                <x-main::input.text id="contentUrl-{{$loop->index}}" class="block w-full"
                                                   type="text" name="seo[schema][videos][{{$loop->index}}][contentUrl]" :value="$video['contentUrl'] ?? '' "/>
                            </div>

                            <div>
                                <x-main::input.label :value="__('embed url')" for="embedUrl-{{$loop->index}}"/>
                                <x-main::input.text id="embedUrl-{{$loop->index}}" class="block w-full"
                                                    type="text" name="seo[schema][videos][{{$loop->index}}][embedUrl]" :value="$video['embedUrl'] ?? '' "/>
                            </div>
                        </div>
                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label value="{{__('duration')}}" for="duration-{{$loop->index}}" />
                                <x-main::input.text id="duration-{{$loop->index}}" class="block w-full" type="text" name="seo[schema][videos][{{$loop->index}}][duration]`" :value="$video['duration'] ?? ''"/>
                            </div>
                            <div class="flex items-center gap-3">
                                <span>
                                    {{__('is family friendly')}}
                                </span>
                                <div>
                                    <div class="flex items-center gap-3">
                                        <x-main::input.radio id="isFamilyFriendly-{{$loop->index}}-yes" name="seo[schema][videos][{{$loop->index}}][isFamilyFriendly]" value="yes" :checked="!isset($video['isFamilyFriendly']) || $video['isFamilyFriendly'] =='yes'"/>
                                        <x-main::input.label :value="__('yes')" for="isFamilyFriendly-{{$loop->index}}-yes"/>

                                    </div>
                                    <div class="flex items-center gap-3">
                                        <x-main::input.radio id="isFamilyFriendly-{{$loop->index}}-no" name="seo[schema][videos][{{$loop->index}}][isFamilyFriendly]" value="no" :checked="isset($video['isFamilyFriendly']) && $video['isFamilyFriendly'] =='no'"/>
                                        <x-main::input.label :value="__('no')" for="isFamilyFriendly-{{$loop->index}}-no"/>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--THUMBNAILs--}}
                    <fieldset class="border border-gray-200 p-3 mb-6">
                        <legend>{{__('thumbnails')}}</legend>
                        @php($rand=random_int(10,9999))
                          @foreach($video['thumbnails'] ?? [] as $thumbnail)
                            <div class="mb-3 flex justify-between items-center gap-6 thumbItems" id="thumb-{{$rand}}{{$i}}-{{$loop->index}}">
                                <div class="w-full">
                                    <x-main::input.label value="{{__('url')}}" for="thumb-{{$rand}}-{{$loop->index}}"/>
                                    <x-main::input.text id="thumb-{{$rand}}-{{$loop->index}}" class="block w-full"
                                                        type="text" name="seo[schema][videos][{{$i}}][thumbnails][]"  maxlength="255" :value="$thumbnail"/>
                                </div>
                                <div>
                                    <button type="button" class="text-red-900"
                                            @click.prevent="document.getElementById('thumb-{{$rand}}{{$i}}-{{$loop->index}}').remove()">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        @endforeach
                          <div
                            x-data="function handler() { return {
                                  fields: [],
                                   addNewThumb() {
                                      this.fields.push({
                                          txt1: ''
                                          });
                                    },
                                    removeThumb(index) {
                                       this.fields.splice(index, 1);
                                     }
                                  }}">
                                 <template x-data="{'lngthThumb' : document.querySelectorAll('.thumbItems').length }" x-for="(field , index) in fields" :key="index">
                            <div class="mb-3 flex justify-between items-center gap-6 thumbItems">
                                <div class="w-full">
                                    <x-main::input.label value="{{__('url')}}" x-bind:for="`thumb-${index + lngthThumb + 1}`"/>
                                    <x-main::input.text x-bind:id="`thumb-${index + lngthThumb + 1}`" class="block w-full"
                                                        type="text" x-bind:name="`seo[schema][videos][{{$loop->index}}][thumbnails][]`"  maxlength="255"/>
                                </div>
                                <div>
                                    <button type="button" class="text-red-900"
                                            @click="removeThumb(index)">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        </template>
                              <div class="flex justify-end">
                                  <x-main::button.primary class="text-xs" type="button" role="button" title="{{__('add thumbnail')}}" @click="addNewThumb()">
                                      {{__('add')}}
                                  </x-main::button.primary>
                              </div>
                         </div>

                     </fieldset>
                    {{--CLIPS--}}
                    <fieldset class="fieldset">
                        <legend>{{__('clips')}}</legend>
                        @php($rand=random_int(10,9999))
                        @foreach($video['clips'] ?? [] as $clip)
                            <div id="clip-{{$rand}}{{$i}}-{{$loop->index}}" class="clipItems">
                                <span class="block">#{{$loop->index + 1}}</span>
                                <div class="mb-3 flex justify-between items-center gap-6">
                                    <div class="w-full">
                                        <x-main::input.label value="{{__('name')}}" for="clip-{{$rand}}-{{$loop->index}}-name"/>
                                        <x-main::input.text id="clip-{{$rand}}-{{$loop->index}}-name" class="block w-full"
                                                            type="text" name="seo[schema][videos][{{$i}}][clips][{{$loop->index}}][name]"  maxlength="255" :value="$clip['name'] ?? ''"/>
                                    </div>
                                    <div>
                                        <button type="button" class="text-red-900"
                                                @click.prevent="document.getElementById('clip-{{$rand}}{{$i}}-{{$loop->index}}').remove()">
                                            &times;
                                        </button>
                                    </div>
                                </div>

                                <div class="w-full mb-3">
                                    <x-main::input.label value="{{__('description')}}" for="clip-{{$rand}}-{{$loop->index}}-description"/>
                                    <x-main::input.textarea  id="clip-{{$rand}}-{{$loop->index}}-description" name="seo[schema][videos][{{$i}}][clips][{{$loop->index}}][description]" class="block w-full" >{{$clip['description'] ?? ''}}</x-main::input.textarea>
                                </div>
                                <div class="mb-3 grid md:grid-cols-2 items-center gap-6 ">
                                    <div class="">
                                        <x-main::input.label value="{{__('thumbnail url')}}" for="clip-{{$rand}}-{{$loop->index}}-thumbnailUrl"/>
                                        <x-main::input.text id="clip-{{$rand}}-{{$loop->index}}-thumbnailUrl" class="block w-full"
                                                            type="text" name="seo[schema][videos][{{$i}}][clips][{{$loop->index}}][thumbnailUrl]`"  maxlength="255" :value="$clip['thumbnailUrl'] ?? ''"/>
                                    </div>
                                    <div class="">
                                        <x-main::input.label value="{{__('url')}}" for="clip-{{$rand}}-{{$loop->index}}-url"/>
                                        <x-main::input.text id="clip-{{$rand}}-{{$loop->index}}-url" class="block w-full"
                                                            type="text" name="seo[schema][videos][{{$i}}][clips][{{$loop->index}}][url]"  maxlength="255" :value="$clip['url'] ?? ''"/>
                                    </div>
                                </div>
                                <div class="mb-3 grid md:grid-cols-2 items-center gap-6 ">
                                    <div class="">
                                        <x-main::input.label value="{{__('start offset')}} (s)" for="clip-{{$rand}}-{{$loop->index}}-startOffset`"/>
                                        <x-main::input.text id="clip-{{$rand}}-{{$loop->index}}-startOffset" class="block w-full"
                                                            type="number" name="seo[schema][videos][{{$i}}][clips][{{$loop->index}}][startOffset]"  maxlength="255" :value="$clip['startOffset']"/>
                                    </div>
                                    <div class="">
                                        <x-main::input.label value="{{__('end offset')}} (s)" for="clip-{{$rand}}-{{$loop->index}}-endOffset"/>
                                        <x-main::input.text id="clip-{{$rand}}-{{$loop->index}}-endOffset" class="block w-full"
                                                            type="number" name="seo[schema][videos][{{$i}}][clips][{{$loop->index}}][endOffset]"  maxlength="255" :value="$clip['endOffset']"/>
                                    </div>
                                </div>




                                <hr class="text-blue-900 my-1">
                            </div>
                        @endforeach

                        <div
                            x-data="function handler() { return {
                                  fields: [],
                                   addNewClip() {
                                      this.fields.push({
                                          txt1: ''
                                          });
                                    },
                                    removeClip(index) {
                                       this.fields.splice(index, 1);
                                     }
                                  }}">
                            <template x-data="{'lngthClip' : document.querySelectorAll('.clipItem').length }" x-for="(field , index) in fields" :key="index">
                                <div class="clipItem">
                                    <span class="px-3" x-text="`#${index + {{count($video['clips'] ?? [])}} + 1}`"></span>
                                    <div class="mb-3 flex justify-between items-center gap-6 ">
                                        <div class="w-full">
                                            <x-main::input.label value="{{__('name')}}" x-bind:for="`thumb-${index + lngthClip + 1}`"/>
                                            <x-main::input.text x-bind:id="`thumb-${index + lngthClip + 1}`" class="block w-full"
                                                                type="text" x-bind:name="`seo[schema][videos][{{$loop->index}}][clips][${index  + {{count($video['clips'] ?? [])}} + 1}][name]`"  maxlength="255"/>
                                        </div>
                                        <div>
                                            <button type="button" class="text-red-900"
                                                    @click="removeClip(index,ind)">
                                                &times;
                                            </button>
                                        </div>
                                    </div>
                                    <div class="w-full mb-3">
                                        <x-main::input.label value="{{__('description')}}" x-bind:for="`clip-${index + lngthClip + 1}-description`"/>
                                        <x-main::input.textarea  x-bind:id="`clip-${index + lngthClip + 1}-description`" x-bind:name="`seo[schema][videos][{{$loop->index}}][clips][${index  + {{count($video['clips'] ?? [])}} + 1}][description]`"
                                                                 class="block w-full" ></x-main::input.textarea>
                                    </div>
                                    <div class="mb-3 grid md:grid-cols-2 items-center gap-6 ">
                                        <div class="">
                                            <x-main::input.label value="{{__('thumbnail url')}}" x-bind:for="`clip-${index + lngthClip + 1}-thumbnailUrl`"/>
                                            <x-main::input.text x-bind:id="`clip-${index + lngthClip + 1}-thumbnailUrl`" class="block w-full"
                                                                type="text" x-bind:name="`seo[schema][videos][{{$loop->index}}][clips][${index  + {{count($video['clips'] ?? [])}} + 1}][thumbnailUrl]`"  maxlength="255"/>
                                        </div>
                                        <div class="">
                                            <x-main::input.label value="{{__('url')}}" x-bind:for="`clip-${index + lngthClip + 1}-url`"/>
                                            <x-main::input.text x-bind:id="`clip-${index + lngthClip + 1}-url`" class="block w-full"
                                                                type="text" x-bind:name="`seo[schema][videos][{{$loop->index}}][clips][${index  + {{count($video['clips'] ?? [])}} + 1}][url]`"  maxlength="255"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 grid md:grid-cols-2 items-center gap-6 ">
                                        <div class="">
                                            <x-main::input.label value="{{__('start offset')}} (s)" x-bind:for="`clip-${index + lngthClip + 1}-startOffset`"/>
                                            <x-main::input.text x-bind:id="`clip-${index + lngthClip + 1}-startOffset`" class="block w-full"
                                                                type="number" x-bind:name="`seo[schema][videos][{{$loop->index}}][clips][${index  + {{count($video['clips'] ?? [])}} + 1}][startOffset]`"  maxlength="255"/>
                                        </div>
                                        <div class="">
                                            <x-main::input.label value="{{__('end offset')}} (s)" x-bind:for="`clip-${index + lngthClip + 1}-endOffset`"/>
                                            <x-main::input.text x-bind:id="`clip-${index + lngthClip + 1}-endOffset`" class="block w-full"
                                                                type="number" x-bind:name="`seo[schema][videos][{{$loop->index}}][clips][${index  + {{count($video['clips'] ?? [])}} + 1}][endOffset]`"  maxlength="255"/>
                                        </div>
                                    </div>
                                    <hr class="text-blue-900 my-1">
                                </div>
                            </template>

                            <div class="flex justify-end">
                                <x-main::button.primary class="text-xs" type="button" role="button" title="{{__('add thumbnail')}}" @click="addNewClip()">
                                    {{__('add clip')}}
                                </x-main::button.primary>
                            </div>
                        </div>
                    </fieldset>
                </fieldset>
            @endforeach
    </div>
    <hr class="mb-3">
    <div
        x-data="function handler() { return {
      fields: [],
       addNewField() {
          this.fields.push({
              txt1: '',txt2: '',txt3: '',txt4: '',txt5: '',txt6: '' ,thumbnails:[] ,clips:[]
              });
        },
       addNewThumb(fieldIndex) {
               this.fields[fieldIndex].thumbnails.push({
                   thumb1: ''
               });
       },
       addNewClip(fieldIndex) {
               this.fields[fieldIndex].clips.push({
                   clip1: '', clip2: '',  clip3: '',  clip4: '', clip5: '', clip6: ''
               });
       },
       removeField(index) {
          this.fields.splice(index, 1);
       },
       removeThumb(fieldIndex, thumbIndex) {
               this.fields[fieldIndex].thumbnails.splice(thumbIndex, 1);
       },
       removeClip(fieldIndex, thumbIndex) {
               this.fields[fieldIndex].clips.splice(thumbIndex, 1);
       }


      }}">
        <fieldset>
            <template x-data="{'lngth' : document.querySelectorAll('.videoItem').length}" x-for="(field, index) in fields" :key="index">
                <fieldset class="fieldset">
                    <legend>
                        <span class="px-3" x-text="`#${index + lngth + 1} Video`"></span>
                    </legend>
                    <fieldset class="fieldset videoItem" x-bind:id="`videoItem-${index + lngth + 1}`">
                       <div>
                           <div class="mb-3 flex justify-between items-center gap-6">
                               <div class="w-full">
                                   <x-main::input.label value="{{__('title')}}" x-bind:for="`title-${index + lngth + 1}`"/>
                                   <x-main::input.text x-bind:id="`title-${index + lngth + 1}`" class="block w-full"
                                                       x-model="field.txt1" type="text" x-bind:name="`seo[schema][videos][${index + lngth + 1}][title]`"  maxlength="255"/>
                               </div>
                               <div>
                                   <button type="button" class="text-red-900" @click="removeField(index)">
                                       &times;
                                   </button>
                               </div>
                           </div>
                           <div class="mb-3">
                               <x-main::input.label x-bind:for="`description-${index + lngth + 1}`"
                                                    value="{{__('description')}}"/>
                               <x-main::input.textarea x-bind:id="`description-${index + lngth + 1}`" class="block w-full" x-model="field.txt2"
                                                       x-bind:name="`seo[schema][videos][${index + lngth + 1}][description]`"></x-main::input.textarea>

                           </div>
                           <div class="mb-3 grid md:grid-cols-2 gap-3">
                               {{--uploadDate--}}
                               <div>
                                   <x-main::input.label value="{{__('upload date')}}" x-bind:for="`uploadDate-${index + lngth + 1}`"/>
                                   <x-main::input.date x-bind:id="`uploadDate-${index + lngth + 1}`" class="block w-full"
                                                       x-model="field.txt3" maxlength="255" type="date"
                                                       x-bind:name="`seo[schema][videos][${index + lngth + 1}][uploadDate]`"/>
                               </div>
                               {{--regionsAllowed--}}
                               <div>
                                   <x-main::input.label value="{{__('regions allowed')}}" x-bind:for="`regionsAllowed-${index + lngth + 1}`"/>
                                   <x-main::input.select x-bind:id="`regionsAllowed-${index + lngth + 1}`"
                                                         x-bind:name="`seo[schema][videos][${index + lngth + 1}][regionsAllowed]`"
                                                         class="block w-full">
                                       @foreach(config('global.area') as $key=>$value)
                                           <option value="{{$key}}"> {{__($value)}} </option>
                                       @endforeach
                                   </x-main::input.select>
                               </div>
                           </div>
                           <div class="mb-3 grid md:grid-cols-2 gap-3">
                               <div>
                                   <x-main::input.label value="{{__('content url')}}" x-bind:for="`contentUrl-${index + lngth + 1}`"/>
                                   <x-main::input.text x-bind:id="`contentUrl-${index + lngth + 1}`" class="block w-full"
                                                       x-model="field.txt4" type="text" x-bind:name="`seo[schema][videos][${index + lngth + 1}][contentUrl]`"/>
                               </div>
                               <div>
                                   <x-main::input.label value="{{__('embed url')}}" x-bind:for="`embedUrl-${index + lngth + 1}`"/>
                                   <x-main::input.text x-bind:id="`embedUrl-${index + lngth + 1}`" class="block w-full"
                                                       x-model="field.txt5" type="text" x-bind:name="`seo[schema][videos][${index + lngth + 1}][embedUrl]`"/>
                               </div>
                           </div>
                           <div class="mb-3 grid md:grid-cols-2 gap-3">
                               <div>
                                   <x-main::input.label value="{{__('duration')}}" x-bind:for="`duration-${index + lngth + 1}`"/>
                                   <x-main::input.text x-bind:id="`duration-${index + lngth + 1}`" class="block w-full"
                                                       x-model="field.txt6" type="text" x-bind:name="`seo[schema][videos][${index + lngth + 1}][duration]`"/>
                               </div>
                               <div class="flex items-center gap-3">
                                <span>
                                    {{__('is family friendly')}}
                                </span>
                                   <div>
                                       <div class="flex items-center gap-3">
                                           <x-main::input.radio x-bind:id="`isFamilyFriendly-${index + lngth + 1}-yes`"
                                                                x-bind:name="`seo[schema][videos][${index + lngth + 1}][isFamilyFriendly]`" value="yes" :checked="true"/>
                                           <x-main::input.label value="{{__('yes')}}" x-bind:for="`isFamilyFriendly-${index + lngth + 1}-yes`"/>

                                       </div>
                                       <div class="flex items-center gap-3">
                                           <x-main::input.radio x-bind:id="`isFamilyFriendly-${index + lngth + 1}-no`"
                                                                x-bind:name="`seo[schema][videos][${index + lngth + 1}][isFamilyFriendly]`" value="no"/>
                                           <x-main::input.label value="{{__('no')}}" x-bind:for="`isFamilyFriendly-${index + lngth + 1}-no`"/>

                                       </div>
                                   </div>
                               </div>
                           </div>

                       </div>
                        <fieldset class="fieldset">
                            <legend>{{__('thumbnails')}}</legend>
                            <template x-data="{'lngthThumb' : document.querySelectorAll('.thumbItems').length }" x-for="(thumb , ind) in field.thumbnails" :key="ind">
                                <div class="mb-3 flex justify-between items-center gap-6 thumbItems">
                                    <div class="w-full">
                                        <x-main::input.label value="{{__('url')}}" x-bind:for="`thumb-${ind + lngthThumb + 1}`"/>
                                        <x-main::input.text x-bind:id="`thumb-${ind + lngthThumb + 1}`" class="block w-full"
                                                             type="text" x-bind:name="`seo[schema][videos][${index + lngth + 1}][thumbnails][]`"  maxlength="255"/>
                                    </div>
                                    <div>
                                        <button type="button" class="text-red-900"
                                                @click="removeThumb(index,ind)">
                                            &times;
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <div class="flex justify-end">
                                <x-main::button.primary class="text-xs" type="button" role="button" title="{{__('add thumbnail')}}" @click="addNewThumb(index)">
                                    {{__('add thumbnail')}}
                                </x-main::button.primary>
                            </div>
                        </fieldset>

                        <fieldset class="fieldset">
                            <legend>{{__('clips')}}</legend>
                            <template x-data="{'lngthClip' : document.querySelectorAll('.clipItem').length }" x-for="(clips , ind) in field.clips" :key="ind">
                                <div class="clipItem">
                                    <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                                    <div class="mb-3 flex justify-between items-center gap-6 ">
                                      <div class="w-full">
                                        <x-main::input.label value="{{__('name')}}" x-bind:for="`clip-${ind + lngthClip + 1}-name`"/>
                                        <x-main::input.text x-bind:id="`clip-${ind + lngthClip + 1}-name`" class="block w-full"
                                                            type="text" x-bind:name="`seo[schema][videos][${index + lngth + 1}][clips][${lngthClip + ind + 1}][name]`"  maxlength="255"/>
                                    </div>
                                      <div>
                                        <button type="button" class="text-red-900"
                                                @click="removeClip(index,ind)">
                                            &times;
                                        </button>
                                    </div>
                                    </div>
                                    <div class="w-full mb-3">
                                        <x-main::input.label value="{{__('description')}}" x-bind:for="`clip-${ind + lngthClip + 1}-description`"/>
                                        <x-main::input.textarea  x-bind:id="`clip-${ind + lngthClip + 1}-description`" x-bind:name="`seo[schema][videos][${index + lngth + 1}][clips][${lngthClip + ind + 1}][description]`"
                                                                 class="block w-full" ></x-main::input.textarea>
                                    </div>
                                    <div class="mb-3 grid md:grid-cols-2 items-center gap-6 ">
                                        <div class="">
                                            <x-main::input.label value="{{__('thumbnail url')}}" x-bind:for="`clip-${ind + lngthClip + 1}-thumbnailUrl`"/>
                                            <x-main::input.text x-bind:id="`clip-${ind + lngthClip + 1}-thumbnailUrl`" class="block w-full"
                                                                type="text" x-bind:name="`seo[schema][videos][${index + lngth + 1}][clips][${lngthClip + ind + 1}][thumbnailUrl]`"  maxlength="255"/>
                                        </div>
                                        <div class="">
                                            <x-main::input.label value="{{__('url')}}" x-bind:for="`clip-${ind + lngthClip + 1}-url`"/>
                                            <x-main::input.text x-bind:id="`clip-${ind + lngthClip + 1}-url`" class="block w-full"
                                                                type="text" x-bind:name="`seo[schema][videos][${index + lngth + 1}][clips][${lngthClip + ind + 1}][url]`"  maxlength="255"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 grid md:grid-cols-2 items-center gap-6 ">
                                        <div class="">
                                            <x-main::input.label value="{{__('start offset')}} (s)" x-bind:for="`clip-${ind + lngthClip + 1}-startOffset`"/>
                                            <x-main::input.text x-bind:id="`clip-${ind + lngthClip + 1}-startOffset`" class="block w-full"
                                                                type="number" x-bind:name="`seo[schema][videos][${index + lngth + 1}][clips][${lngthClip + ind + 1}][startOffset]`"  maxlength="255"/>
                                        </div>
                                        <div class="">
                                            <x-main::input.label value="{{__('end offset')}} (s)" x-bind:for="`clip-${ind + lngthClip + 1}-endOffset`"/>
                                            <x-main::input.text x-bind:id="`clip-${ind + lngthClip + 1}-endOffset`" class="block w-full"
                                                                type="number" x-bind:name="`seo[schema][videos][${index + lngth + 1}][clips][${lngthClip + ind + 1}][endOffset]`"  maxlength="255"/>
                                        </div>
                                    </div>
                                    <hr class="text-blue-900 my-1">
                                </div>
                            </template>

                            <div class="flex justify-end">
                                <x-main::button.primary class="text-xs" type="button" role="button" title="{{__('add thumbnail')}}" @click="addNewClip(index)">
                                    {{__('add clip')}}
                                </x-main::button.primary>
                            </div>
                        </fieldset>

                    </fieldset>
                </fieldset>
            </template>
            <div>
                <x-main::button.primary type="button" role="button" title="{{__('add title')}}" id="addVideo" @click="addNewField()">
                    {{__('add')}}
                </x-main::button.primary>

            </div>
        </fieldset>
    </div>
</section>
