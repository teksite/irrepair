@section('title' , __('edit :title',['title'=>__('local business')]))
<x-main::box class="">
    <div class="flex items-center gap-1">
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-3">
                <x-main::input.radio id="status_yes" class="" name="stance" :checked="$seo->stance == 'on'" value="on"/>
                <x-main::input.label for="status_yes" :value="__('activate')" class="!mb-0"/>
            </div>
            <div class="flex items-center gap-3">
                <x-main::input.radio id="status_no" class="" name="stance" :checked="$seo->stance == 'off'"
                                     value="off"/>
                <x-main::input.label for="status_no" :value="__('deactivate')" class="!mb-0"/>
            </div>
        </div>
        <x-main::input.error :messages="$errors->get('stance')" class="mt-2"/>
        <input type="hidden" class="hidden" name="key" value="seo_localBusiness">

    </div>
    <fieldset class="fieldset my-6" >
        <legend>
            <h3>{{__('information')}}</h3>
        </legend>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
        <table class="mb-3 w-full">
            <tbody>
            {{--type--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('type')}}" for="localBusiness_type"/>
                </th>
                <td class="text-start">
                    <x-main::input.select id="localBusiness_type" name="web[type]" class="block w-full">
                        @foreach(config('global.seoschematype.localBusiness_type') as $key=>$value)
                            <optgroup label="{{__($key)}}">
                                @foreach($value as $typ)
                                    <option value="{{$typ}}"
                                        {{(old('web.type') == $typ ||  (isset($seo->value['type']) && $seo->value['type']==$typ ))? 'selected' :''}}>
                                        {{__($typ)}}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach

                    </x-main::input.select>
                    <x-main::input.error :messages="$errors->get('web.type')"/>
                </td>
            </tr>
            {{--name--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('name')}}" for="localBusiness_name"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_name" name="web[name]" class="block w-full"
                                        :value="old('web.name') ?? $seo->value['name'] ??  __(config('app.name'))"/>
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
                    >{{old('web.name') ?? $seo->value['description'] ?? "" }}</x-main::input.textarea>
                    <x-main::input.error :messages="$errors->get('web.description')"/>
                </td>
            </tr>

            {{--url--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('url')}}" for="localBusiness_url"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_url" name="web[url]" class="block w-full"
                                        dir="ltr" type="url" :disabled="true"
                                        :value="old('web.url') ?? $seo->value['url'] ?? env('APP_URL')"/>
                    <x-main::input.error :messages="$errors->get('web.url')"/>
                </td>
            </tr>

            {{--image--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('image url')}}" for="localBusiness_image"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_image" name="web[image]" class="block w-full"
                                        dir="ltr" type="url"
                                        :value="old('web.image') ?? $seo->value['image'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.image')"/>
                </td>
            </tr>
            {{--id--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('id url')}}" for="localBusiness_id"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_id" name="web[id]" class="block w-full"
                                        dir="ltr" type="url"
                                        :value="old('web.id') ?? $seo->value['id'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.id')"/>
                </td>
            </tr>
            {{--telephone--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('telephone')}}" for="localBusiness_telephone"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_telephone" name="web[telephone]" class="block w-full"
                                        dir="ltr" type="tel"
                                        :value="old('web.telephone') ?? $seo->value['telephone'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.telephone')"/>
                </td>
            </tr>

            {{--street--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('street')}}" for="localBusiness_streetAddress"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_streetAddress" name="web[streetAddress]"
                                        class="block w-full"
                                        :value="old('web.streetAddress') ?? $seo->value['streetAddress'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.streetAddress')"/>
                </td>
            </tr>
            {{--city--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('city')}}" for="localBusiness_addressLocality"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_addressLocality" name="web[addressLocality]"
                                        class="block w-full"
                                        :value="old('web.addressLocality') ?? $seo->value['addressLocality'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.addressLocality')"/>
                </td>
            </tr>
            {{--zip code--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('zip/postal code')}}" for="localBusiness_postalCode"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_postalCode" name="web[postalCode]"
                                        class="block w-full"
                                        :value="old('web.postalCode') ?? $seo->value['postalCode'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.postalCode')"/>
                </td>
            </tr>

            {{--country--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('country')}}" for="localBusiness_addressCountry"/>
                </th>
                <td class="text-start">
                    <x-main::input.select id="localBusiness_addressCountry" name="web[addressCountry]"
                                          class="block w-full">
                        @foreach(config('global.area') as $key=>$value)
                            <option value="{{$key}}"
                                {{(old('web.addressCountry') == $key || (isset($seo->value['addressCountry']) && $seo->value['addressCountry'] ==$key) )? 'selected' :''}}>
                                {{__($value)}}
                            </option>
                        @endforeach

                    </x-main::input.select>
                    <x-main::input.error :messages="$errors->get('web.type')"/>
                </td>
            </tr>

            {{--latitude--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('latitude')}}" for="localBusiness_latitude"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_latitude" name="web[latitude]" class="block w-full"
                                        :value="old('web.latitude') ?? $seo->value['latitude'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.latitude')"/>
                </td>
            </tr>

            {{--longitude--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('longitude')}}" for="localBusiness_longitude"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_longitude" name="web[longitude]" class="block w-full"
                                        :value="old('web.longitude') ?? $seo->value['longitude'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.longitude')"/>
                </td>
            </tr>

            </tbody>
        </table>

        <table class="mb-3 w-full">
            <thead>
            <tr>
                <th colspan="2">
                    {{__('hours')}}
                </th>
            </tr>
            </thead>
            <tbody>
            {{--monday--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('monday')}}" for="localBusiness_monday"/>
                </th>
                <td class="text-start">
                    <div>
                        <x-main::input.text id="localBusiness_monday"
                                            name="web[OpeningHoursSpecification][monday]"
                                            class="block w-full" placeholder="00:00-23:59"
                                            dir="ltr"
                                            :value="old('web.monday') ?? $seo->value['OpeningHoursSpecification']['monday'] ?? ''"/>
                    </div>
                    <x-main::input.error :messages="$errors->get('web.OpeningHoursSpecification.monday')"/>
                </td>
            </tr>
            {{--tuesday--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('tuesday')}}" for="localBusiness_tuesday"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_tuesday"
                                        name="web[OpeningHoursSpecification][tuesday]"
                                        class="block w-full" placeholder="00:00-23:59"
                                        dir="ltr"
                                        :value="old('web.tuesday') ?? $seo->value['OpeningHoursSpecification']['tuesday'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.OpeningHoursSpecification.tuesday')"/>
                </td>
            </tr>
            {{--wednesday--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('wednesday')}}" for="localBusiness_wednesday"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_wednesday"
                                        name="web[OpeningHoursSpecification][wednesday]"
                                        class="block w-full" placeholder="00:00-23:59"
                                        dir="ltr"
                                        :value="old('web.wednesday') ?? $seo->value['OpeningHoursSpecification']['wednesday'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.OpeningHoursSpecification.wednesday')"/>
                </td>
            </tr>
            {{--thursday--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('thursday')}}" for="localBusiness_thursday"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_thursday"
                                        name="web[OpeningHoursSpecification][thursday]"
                                        class="block w-full" placeholder="00:00-23:59"
                                        dir="ltr"
                                        :value="old('web.thursday') ?? $seo->value['OpeningHoursSpecification']['thursday'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.OpeningHoursSpecification.thursday')"/>
                </td>
            </tr>

            {{--friday--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('friday')}}" for="localBusiness_friday"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_friday" name="web[OpeningHoursSpecification][friday]"
                                        class="block w-full" placeholder="00:00-23:59"
                                        dir="ltr"
                                        :value="old('web.friday') ?? $seo->value['OpeningHoursSpecification']['friday'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.OpeningHoursSpecification.friday')"/>
                </td>
            </tr>
            {{--saturday--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('saturday')}}" for="localBusiness_saturday"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_saturday"
                                        name="web[OpeningHoursSpecification][saturday]"
                                        class="block w-full" placeholder="00:00-23:59"
                                        dir="ltr"
                                        :value="old('web.saturday') ?? $seo->value['OpeningHoursSpecification']['saturday'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.OpeningHoursSpecification.saturday')"/>
                </td>
            </tr>
            {{--sunday--}}
            <tr>
                <th class="text-start">
                    <x-main::input.label value="{{__('sunday')}}" for="localBusiness_sunday"/>
                </th>
                <td class="text-start">
                    <x-main::input.text id="localBusiness_sunday" name="web[OpeningHoursSpecification][sunday]"
                                        class="block w-full"
                                        dir="ltr" placeholder="00:00-23:59"
                                        :value="old('web.sunday') ?? $seo->value['OpeningHoursSpecification']['sunday'] ?? ''"/>
                    <x-main::input.error :messages="$errors->get('web.OpeningHoursSpecification.sunday')"/>
                </td>
            </tr>


            </tbody>
        </table>
    </div>
    </fieldset>
</x-main::box>
