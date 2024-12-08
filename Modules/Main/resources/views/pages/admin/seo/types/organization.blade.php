@section('title' , __('edit :title',['title'=>__('organization')]))
<x-main::box class="">
    <div class="flex items-center gap-1">
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-3">
                <x-main::input.radio id="status_yes" class="" name="stance" :checked="$seo->stance == 'on'" value="on"/>
                <x-main::input.label for="status_yes" :value="__('activate')" class="!mb-0"/>
            </div>
            <div class="flex items-center gap-3">
                <x-main::input.radio id="status_no" class="" name="stance" :checked="$seo->stance == 'off'" value="off"/>
                <x-main::input.label for="status_no" :value="__('deactivate')" class="!mb-0"/>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('stance')" class="mt-2"/>
        <input type="hidden" class="hidden" name="key" value="seo_organization">

    </div>

    <fieldset class="fieldset my-6" >
        <legend>
            <h3>{{__('information')}}</h3>
        </legend>

<div class="grid gap-6 lg:grid-cols-2">
    {{--details--}}
        <table class="mb-3 w-full">
            <tbody id="seoSettingCorporationDetailsTable">
            {{--name--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('name')}}" for="organization_name"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_name" name="web[name]" class="block w-full"
                                        :value="old('web.name') ?? $seo->value['name'] ?? __(config('app.name'))"/>
                    <x-main::input.error :messages="$errors->get('web.name')"/>
                </td>
            </tr>
            {{--description--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('description')}}" for="localBusiness_description"/>
                </th>
                <td class="text-start">
                    <x-main::input.textarea id="localBusiness_description" name="web[description]" class="block w-full"
                    >{{old('web.name') ?? $seo->value['description'] ?? ""}}</x-main::input.textarea>
                    <x-main::input.error :messages="$errors->get('web.description')"/>
                </td>
            </tr>

            {{--alt name--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('alternative name')}}" for="organization_alt_name"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_alt_name" name="web[alt_name]" class="block w-full"
                                        :value="old('web.alt_name') ?? $seo->value['alt_name'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.alt_name')"/>
                </td>
            </tr>

            {{--url--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('url')}}" for="organization_url"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_url" name="web[url]" class="block w-full"
                                        dir="ltr" type="url" :disabled="true"
                                        :value="old('web.url') ?? $seo->value['url'] ?? config('app.url')"/>
                    <x-main::input.error :messages="$errors->get('web.url')"/>
                </td>
            </tr>

            {{--logo url--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('logo url')}}" for="organization_logo_url"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_logo_url" name="web[logo_url]" class="block w-full"
                                        dir="ltr" type="logo_url"
                                        :value="old('web.logo_url') ?? $seo->value['logo_url'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.logo_url')"/>
                </td>
            </tr>

            {{--type--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('type')}}" for="organization_type"/>
                </th>
                <td class="text-start">
                    <x-main::input.select id="organization_type" name="web[type]" class="block w-full">
                        @foreach(config('global.seoschematype.organization_type') as $key=>$value)
                            <optgroup label="{{__($key)}}">
                                @foreach($value as $tp)
                                    <option value="{{$tp}}"
                                        {{(old('web.type') == $tp || (isset($seo->value['type'])) && $seo->value['type']==$tp  ) ? 'selected' :''}}>
                                        {{__($tp)}}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach

                    </x-main::input.select>
                    <x-main::input.error :messages="$errors->get('web.type')"/>
                </td>
            </tr>

            </tbody>
        </table>
    {{--social--}}
        <table class="mb-3 w-full">
            <tbody id="seoSettingCorporationSocialTable">
            {{--whatsapp--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('whatsapp')}}" for="organization_whatsapp"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_whatsapp" name="web[social][whatsapp]"
                                        class="block w-full"
                                        dir="ltr"
                                        :value="old('web.whatsapp') ?? $seo->value['social']['whatsapp'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.social.whatsapp')"/>
                </td>
            </tr>
            {{--instagram--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('instagram')}}" for="organization_instagram"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_instagram" name="web[social][instagram]"
                                        class="block w-full"  dir="ltr" :value="old('web.instagram') ?? $seo->value['social']['instagram'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.social.instagram')"/>
                </td>
            </tr>
            {{--facebook--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('facebook')}}" for="organization_facebook"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_facebook" name="web[social][facebook]"
                                        class="block w-full" dir="ltr" :value="old('web.facebook') ?? $seo->value['social']['facebook'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.social.facebook')"/>
                </td>
            </tr>
            {{--linkedin--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('linkedin')}}" for="organization_linkedin"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_linkedin" name="web[social][linkedin]"
                                        class="block w-full" dir="ltr"  :value="old('web.linkedin') ?? $seo->value['social']['linkedin'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.social.linkedin')"/>
                </td>
            </tr>
            {{--telegram--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('telegram')}}" for="organization_telegram"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_telegram" name="web[social][telegram]"
                                        class="block w-full" dir="ltr"  :value="old('web.telegram') ?? $seo->value['social']['telegram'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.social.telegram')"/>
                </td>
            </tr>
            {{--wikipedia--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('wikipedia')}}" for="organization_wikipedia"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_wikipedia" name="web[social][wikipedia]"
                                        class="block w-full" dir="ltr" :value="old('web.wikipedia') ?? $seo->value['social']['wikipedia'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.social.wikipedia')"/>
                </td>
            </tr>
            {{--twitter--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('twitter')}}" for="organization_twitter"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_twitter" name="web[social][twitter]"
                                        class="block w-full" dir="ltr"
                                        :value="old('web.twitter') ?? $seo->value['social']['twitter'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.social.twitter')"/>
                </td>
            </tr>
            {{--github--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('github')}}" for="organization_github"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="organization_github" name="web[social][github]" class="block w-full"
                                        dir="ltr"
                                        :value="old('web.github') ?? $seo->value['social']['github'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.social.github')"/>
                </td>
            </tr>
            </tbody>
        </table>
</div>
    </fieldset>
</x-main::box>

<x-main::box class="">
    <fieldset class="fieldset" >
        <legend>
            <h4>{{__('contact')}}</h4>
        </legend>

    <table class="mb-3 w-full">
            <tbody id="seoSettingCorporationContactTable">
            @if(isset($seo->value['contacts']))
                @foreach($seo->value['contacts'] as $cntct )
                    <tr id="contactItem-{{$loop->index}}" class="contactItem mb-6 border border-slate-200">
                        <td class="p-1">
                            <div class="mb-3 gap-3 flex items-center">
                                <div class="w-full">
                                    <div>
                                        <x-main::input.label value="{{__('telephone')}}"/>
                                        <x-main::input.text class="block w-full" name="web[contacts][{{$loop->index}}][telephone]"
                                                            :value="$cntct['telephone'] ?? ''"/>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div>
                                        <x-main::input.label value="{{__('email')}}"/>
                                        <x-main::input.text class="block w-full"
                                                            name="web[contacts][{{$loop->index}}][email]"
                                                            :value="$cntct['email'] ?? ''"/>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div>
                                        <x-main::input.label value="{{__('type')}}"/>
                                        <x-main::input.select class="block w-full"
                                                              name="web[contacts][{{$loop->index}}][contactType]">
                                            @foreach(config('global.seoschematype.contact_type') as $type)
                                                <option
                                                    value="{{$type}}" {{$cntct['contactType'] == $type ? 'selected':''}}
                                                >{{__($type)}}</option>
                                            @endforeach
                                        </x-main::input.select>

                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 gap-3 flex items-center">
                                <div class="w-full">
                                    <div>
                                        <x-main::input.label value="{{__('options')}}"/>
                                        <x-main::input.select class="block w-full" multiple
                                                              name="web[contacts][{{$loop->index}}][contactOption][]">
                                            @foreach(config('global.seoschematype.contactOption') as $option)
                                                <option value="{{$option}}"
                                                    {{(isset($cntct['contactOption']) && in_array($option,$cntct['contactOption'])) ? 'selected' :''}}
                                                >{{__($option)}}</option>
                                            @endforeach
                                        </x-main::input.select>

                                    </div>
                                </div>

                                <div class="w-full">
                                    <div>
                                        <x-main::input.label value="{{__('available language')}}"/>
                                        <x-main::input.select class="block w-full" multiple
                                                              name="web[contacts][{{$loop->index}}][availableLanguage][]">
                                            @foreach(config('global.lang') as $lang=>$lg)
                                                <option value="{{$lang}}"
                                                    {{(isset($cntct['availableLanguage']) && in_array($lang,$cntct['availableLanguage'])) ? 'selected' :''}}
                                                >{{__($lg)}}</option>
                                            @endforeach
                                        </x-main::input.select>

                                    </div>
                                </div>
                                <div class="w-full">
                                    <div>
                                        <x-main::input.label value="{{__('area served')}}"/>
                                        <x-main::input.select class="block w-full" multiple
                                                              name="web[contacts][{{$loop->index}}][areaServed][]">
                                            @foreach(config('global.area') as $area=>$country)
                                                <option value="{{$area}}"
                                                    {{(isset($cntct['areaServed']) && in_array($area,$cntct['areaServed'])) ? 'selected' :''}}
                                                >{{__($country)}}</option>
                                            @endforeach
                                        </x-main::input.select>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <x-main::button.danger onclick="document.getElementById('contactItem-{{$loop->index}}').remove()" role="button" type="button" class="text-xs !p-1 deleteItemBtn" target="contactItem-{{$loop->index}}">
                                    {{__('delete')}}
                                </x-main::button.danger>
                            </div>
                        </td>
                    </tr>
                @endforeach

            @endif
            </tbody>
        </table>

    <div x-data="function handler() { return {
      fields: [],
      addNewField() { this.fields.push({  txt1: '', txt2: '', txt3: '', txt4: '', txt5: '', txt6: '' }); },
        removeField(index) { this.fields.splice(index, 1); }
      } }">
        <div>
            <template x-data="{'lngth' : document.querySelectorAll('.contactItem').length}"
                      x-for="(field, index) in fields"
                      :key="index">
                <div class="contactItem" x-bind:id="`contact-${index + lngth + 1}`">
                    <div class="grid gap-3 md:grid-cols-3 my-3">
                        <div>
                            <x-main::input.label value="{{__('telephone')}}"
                                                 x-bind:for="`contact-telephone-${index + lngth + 1}`"/>
                            <x-main::input.text x-bind:id="`contact-telephone-${index + lngth + 1}`"
                                                class="block mt-1 w-full"
                                                x-model="field.txt1"
                                                type="text"
                                                x-bind:name="`web[contacts][${index + lngth + 1}][telephone]`"/>
                            <x-main::input.error :messages="$errors->get('web.contacts.*.*.telephone')"
                                                 class="mt-2"/>
                        </div>
                        <div>
                            <x-main::input.label value="{{__('email')}}"
                                                 x-bind:for="`contact-email-${index + lngth + 1}`"/>
                            <x-main::input.text x-bind:id="`contact-email-${index + lngth + 1}`"
                                                class="block mt-1 w-full"
                                                x-model="field.txt2"
                                                type="email" dir="ltr"
                                                x-bind:name="`web[contacts][${index + lngth + 1}][email]`"/>
                            <x-main::input.error :messages="$errors->get('web.contacts.*.*.email')"
                                                 class="mt-2"/>
                        </div>
                        <div>
                            <x-main::input.label value="{{__('contact type')}}"
                                                 x-bind:for="`contact-type-${index + lngth + 1}`"/>
                            <x-main::input.select x-bind:id="`contact-type-${index + lngth + 1}`"
                                                  class="block mt-1 w-full"
                                                  x-model="field.txt3"
                                                  x-bind:name="`web[contacts][${index + lngth + 1}][contactType]`">
                                @foreach(config('global.seoschematype.contact_type') as $type)
                                    <option value="{{$type}}">{{__($type)}}</option>
                                @endforeach
                            </x-main::input.select>
                            <x-main::input.error :messages="$errors->get('web.contacts.*.*.contactType')"
                                                 class="mt-2"/>
                        </div>
                    </div>
                    <div class="grid gap-3 md:grid-cols-3 my-3">
                        <div>
                            <x-main::input.label value="{{__('contact option')}}"
                                                 x-bind:for="`contact-option-${index + lngth + 1}`"/>
                            <x-main::input.select x-bind:id="`contact-option-${index + lngth + 1}`" multiple
                                                  class="block mt-1 w-full select-box-no-creation"
                                                  x-model="field.txt4"
                                                  x-bind:name="`web[contacts][${index + lngth + 1}][contactOption][]`">
                                @foreach(config('global.seoschematype.contactOption') as $type)
                                    <option value="{{$type}}">{{__($type)}}</option>
                                @endforeach
                            </x-main::input.select>
                            <x-main::input.error :messages="$errors->get('web.contacts.*.*.contactOption')"
                                                 class="mt-2"/>
                        </div>
                        <div>
                            <x-main::input.label value="{{__('available language')}}"
                                                 x-bind:for="`contact-language-${index + lngth + 1}`"/>
                            <x-main::input.select x-bind:id="`contact-language-${index + lngth + 1}`" multiple
                                                  class="block mt-1 w-full select-box-no-creation"
                                                  x-model="field.txt5"
                                                  x-bind:name="`web[contacts][${index + lngth + 1}][availableLanguage][]`">
                                @foreach(config('global.lang') as $lang=>$lg)
                                    <option value="{{$lang}}">{{__($lg)}}</option>
                                @endforeach
                            </x-main::input.select>
                            <x-main::input.error :messages="$errors->get('web.contacts.*.*.availableLanguage')"
                                                 class="mt-2"/>
                        </div>
                        <div>
                            <x-main::input.label value="{{__(' area served')}}"
                                                 x-bind:for="`contact-area-${index + lngth + 1}`"/>
                            <x-main::input.select x-bind:id="`contact-area-${index + lngth + 1}`" multiple
                                                  class="block mt-1 w-full select-box-no-creation"
                                                  x-model="field.txt6"
                                                  x-bind:name="`web[contacts][${index + lngth + 1}][areaServed][]`">
                                @foreach(config('global.area') as $area=>$country)
                                    <option value="{{$area}}">{{__($country)}}</option>
                                @endforeach
                            </x-main::input.select>
                            <x-main::input.error :messages="$errors->get('web.contacts.*.*.areaServed')"
                                                 class="mt-2"/>
                        </div>
                    </div>
                    <div>
                        <x-main::button.danger type="button text-xs !p-1 " @click="removeField(index)">
                            {{__('delete')}}
                        </x-main::button.danger>
                    </div>
                </div>
            </template>
            <div class="mt-6">
                <x-main::button.primary type="button" role="button" title="{{__('add question')}}" id="addQuestion"
                                        @click="addNewField()">
                    {{__('add')}}
                </x-main::button.primary>

            </div>
        </div>
    </div>
    </fieldset>
</x-main::box>


