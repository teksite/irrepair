
<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="JobPosition" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="JobPosition" class="hidden"  type="hidden"/>
    <div id="schema-title-section">

            @foreach($schema['jobPositions'] ?? [] as $job)
                <fieldset class="fieldset jobItem" id="jobItem-{{$loop->index}}">
                    <legend>
                        <span class="px-3">#{{$loop->index + 1}}</span>
                    </legend>
                    <div class="" >
                        <div class="mb-3 flex justify-between items-center gap-6">
                            <div class="w-full">
                                <x-main::input.label value="{{__('title')}}" for="title-{{$loop->index}}"/>
                                <x-main::input.text id="title-{{$loop->index}}" class="block w-full"
                                                    type="text" name="seo[schema][jobPositions][{{$loop->index}}][title]"
                                                    maxlength="255" :value="$job['title'] ?? ''"/>
                                <x-main::input.error :messages="$errors->get('schema.jobPositions.*.title')" class="mt-2"/>
                            </div>
                            <div>
                                <button type="button" class="text-red-900"
                                        @click.prevent="document.getElementById('jobItem-{{$loop->index}}').remove()">
                                    &times;
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-main::input.label for="description-{{$loop->index}}" value="{{__('description')}}"/>
                            <x-main::input.textarea id="description-{{$loop->index}}" class="block w-full"
                                                    name="seo[schema][jobPositions][{{$loop->index}}][description]">{{$job['description'] ?? '' }}</x-main::input.textarea>
                            <x-main::input.error :messages="$errors->get('schema.jobPositions.*.description')" class="mt-2"/>

                        </div>
                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label value="{{__('until')}}" for="until-{{$loop->index}}"/>
                                <x-main::input.date id="until-{{$loop->index}}" class="block w-full"
                                                     maxlength="255" type="date" name="seo[schema][jobPositions][{{$loop->index}}][until]"
                                :value="$job['until'] ?? ''"/>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('type')}}" for="type-{{$loop->index}}"/>
                                <x-main::input.select id="type-{{$loop->index}}" class="block w-full" name="seo[schema][jobPositions][{{$loop->index}}][type]">
                                    @foreach(config('global.seoschematype.pageType.JobPosition.employmentType') as $type=>$title)
                                        <option value="{{$type}}" {{$job['type']==$type ? 'selected': ''}}>{{__($title)}}</option>
                                    @endforeach
                                </x-main::input.select>
                            </div>
                        </div>
                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label value="{{__('company')}}" for="company-{{$loop->index}}"/>
                                <x-main::input.select id="company-{{$loop->index}}" class="block w-full"
                                                      type="date" name="seo[schema][jobPositions][{{$loop->index}}][companyType]">
                                    @foreach(config('global.seoschematype.pageType.JobPosition.CompanyType') as $type=>$title)
                                        <option value="{{$type}}" {{$job['companyType']==$type ? 'selected' : ''}}>{{__($title)}}</option>

                                    @endforeach
                                </x-main::input.select>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('company title')}}" for="type-{{$loop->index}}"/>
                                <x-main::input.text id="type-{{$loop->index}}" class="block w-full" name="seo[schema][jobPositions][{{$loop->index}}][companyTitle]"
                                :value="$job['companyTitle'] ?? '' "/>
                            </div>

                        </div>
                        <hr class="my-6">

                        <div class="mb-3 grid md:grid-cols-3 gap-3">
                            <div>
                                <x-main::input.label value="{{__('unit salary')}}"  for="unit-{{$loop->index}}"/>
                                <x-main::input.select id="unit-{{$loop->index}}" class="block w-full" type="date" name="seo[schema][jobPositions][{{$loop->index}}][unit]">
                                    @foreach(config('global.seoschematype.pageType.JobPosition.salaryUnit') as $type=>$title)
                                        <option value="{{$type}}" {{$job['unit'] ==$type ? 'selected' : ''}}>{{__($title)}}</option>

                                    @endforeach
                                </x-main::input.select>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('salary')}}" for="salary-{{$loop->index}}"/>
                                <x-main::input.text type="number" id="salary-{{$loop->index}}" class="block w-full"  name="seo[schema][jobPositions][{{$loop->index}}][salary]"
                                :value="$job['salary'] ?? ''"
                                />
                            </div>
                        </div>
                    </div>
                    <hr class="my-6">

                    <div class="mb-3 grid md:grid-cols-2 gap-3">
                        {{--country--}}
                        <div>
                            <x-main::input.label value="{{__('country')}}" for="country-{{$loop->index}}"/>
                            <x-main::input.select id="country-{{$loop->index}}" name="seo[schema][jobPositions][{{$loop->index}}][country]"
                                                  class="block w-full">
                                @foreach(config('global.area') as $key=>$value)
                                    <option value="{{$key}}" {{$job['country']==$key ? 'selected': ''}}> {{__($value)}} </option>
                                @endforeach
                            </x-main::input.select>
                        </div>
                        {{--city--}}
                        <div>
                            <x-main::input.label value="{{__('city')}}" for="city-{{$loop->index}}"/>
                            <x-main::input.text id="city-{{$loop->index}}" name="seo[schema][jobPositions][{{$loop->index}}][city]"
                                                class="block w-full" :value="$job['city'] ?? ''"/>
                        </div>
                        {{--street--}}
                        <div>
                            <x-main::input.label value="{{__('street')}}" for="street-{{$loop->index}}"/>
                            <x-main::input.text id="street-{{$loop->index}}" name="seo[schema][jobPositions][{{$loop->index}}][street]"
                                                class="block w-full" :value="$job['street'] ?? ''"/>
                        </div>
                        {{--zip code--}}
                        <div>
                            <x-main::input.label value="{{__('zip code')}}" for="zipcode-{{$loop->index}}"/>
                            <x-main::input.text id="zipcode-{{$loop->index}}" name="seo[schema][jobPositions][{{$loop->index}}][zipcode]"
                                                class="block w-full" :value="$job['zipcode'] ?? ''"/>
                        </div>
                    </div>

                </fieldset>
            @endforeach
    </div>

    <hr class="mb-3">


    <div x-data="function handler() {
     return {
      fields: [],
       addNewField() {
          this.fields.push({
              txt1: '',txt2: '',txt3: '',txt4: '',txt5: '',txt6: '',txt7: '',txt8: '',txt9: ''});
        },
        removeField(index) {
           this.fields.splice(index, 1);
         }
      }
      }">
        <div>
            <template x-data="{'lngth' : document.querySelectorAll('.jobItem').length}" x-for="(field, index) in fields"
                      :key="index">
                <fieldset class="fieldset">
                    <legend>
                        <span class="px-3" x-text="`#${index + lngth + 1}`"></span>
                    </legend>
                    <div class="jobItem" x-bind:id="`jobItem-${index + lngth + 1}`">
                        <div class="mb-3 flex justify-between items-center gap-6">
                            <div class="w-full">
                                <x-main::input.label value="{{__('title')}}" x-bind:for="`title-${index + lngth + 1}`"/>
                                <x-main::input.text x-bind:id="`title-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt1"
                                                    type="text" x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][title]`"
                                                    maxlength="255"/>
                                <x-main::input.error :messages="$errors->get('meta.faq.*.title')" class="mt-2"/>
                            </div>
                            <div>
                                <button type="button" class="text-red-900"
                                        @click="removeField(index)">
                                    &times;
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-main::input.label x-bind:for="`description-${index + lngth + 1}`"
                                                 value="{{__('description')}}"/>
                            <x-main::input.textarea x-bind:id="`description-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt2"
                                                    x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][description]`"></x-main::input.textarea>
                            <x-main::input.error :messages="$errors->get('meta.description')" class="mt-2"/>

                        </div>
                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label value="{{__('until')}}" x-bind:for="`until-${index + lngth + 1}`"/>
                                <x-main::input.date x-bind:id="`until-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt3" maxlength="255" type="date"
                                                    x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][until]`"/>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('type')}}" x-bind:for="`type-${index + lngth + 1}`"/>
                                <x-main::input.select x-bind:id="`type-${index + lngth + 1}`" class="block w-full"
                                                      x-model="field.txt4"
                                                      x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][type]`">
                                    @foreach(config('global.seoschematype.pageType.JobPosition.employmentType') as $type=>$title)
                                        <option value="{{$type}}">{{__($title)}}</option>
                                    @endforeach
                                </x-main::input.select>
                            </div>
                        </div>
                        <div class="mb-3 grid md:grid-cols-2 gap-3">
                            <div>
                                <x-main::input.label value="{{__('company')}}"
                                                     x-bind:for="`company-${index + lngth + 1}`"/>
                                <x-main::input.select x-bind:id="`company-${index + lngth + 1}`" class="block w-full"
                                                      x-model="field.txt5"
                                                      type="date"
                                                      x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][companyType]`">
                                    @foreach(config('global.seoschematype.pageType.JobPosition.CompanyType') as $type=>$title)
                                        <option value="{{$type}}">{{__($title)}}</option>

                                    @endforeach
                                </x-main::input.select>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('company title')}}"
                                                     x-bind:for="`type-${index + lngth + 1}`"/>
                                <x-main::input.text x-bind:id="`type-${index + lngth + 1}`" class="block w-full"
                                                    x-model="field.txt6"
                                                    x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][companyTitle]`"/>
                            </div>

                        </div>
                        <hr class="my-6">

                        <div class="mb-3 grid md:grid-cols-3 gap-3">
                            <div>
                                <x-main::input.label value="{{__('unit salary')}}"
                                                     x-bind:for="`unit-${index + lngth + 1}`"/>
                                <x-main::input.select x-bind:id="`unit-${index + lngth + 1}`" class="block w-full"
                                                      x-model="field.txt7"
                                                      type="date" x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][unit]`">
                                    @foreach(config('global.seoschematype.pageType.JobPosition.salaryUnit') as $type=>$title)
                                        <option value="{{$type}}">{{__($title)}}</option>

                                    @endforeach
                                </x-main::input.select>
                            </div>
                            <div>
                                <x-main::input.label value="{{__('salary')}}"
                                                     x-bind:for="`salary-${index + lngth + 1}`"/>
                                <x-main::input.text type="number" x-bind:id="`salary-${index + lngth + 1}`"
                                                    class="block w-full" x-model="field.txt8"
                                                    x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][salary]`"/>
                            </div>
                        </div>
                    </div>
                    <hr class="my-6">

                    <div class="mb-3 grid md:grid-cols-2 gap-3">
                        {{--country--}}
                        <div>
                            <x-main::input.label value="{{__('country')}}" x-bind:for="`country-${index + lngth + 1}`"/>
                            <x-main::input.select x-bind:id="`country-${index + lngth + 1}`"
                                                  x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][country]`"
                                                  class="block w-full">
                                @foreach(config('global.area') as $key=>$value)
                                    <option value="{{$key}}"> {{__($value)}} </option>
                                @endforeach
                            </x-main::input.select>
                        </div>
                        {{--city--}}
                        <div>
                            <x-main::input.label value="{{__('city')}}" x-bind:for="`city-${index + lngth + 1}`"/>
                            <x-main::input.text x-bind:id="`city-${index + lngth + 1}`"
                                                x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][city]`"
                                                class="block w-full"/>
                        </div>
                        {{--street--}}
                        <div>
                            <x-main::input.label value="{{__('street')}}" x-bind:for="`street-${index + lngth + 1}`"/>
                            <x-main::input.text x-bind:id="`street-${index + lngth + 1}`"
                                                x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][street]`"
                                                class="block w-full"/>
                        </div>
                        {{--zip code--}}
                        <div>
                            <x-main::input.label value="{{__('zip code')}}"
                                                 x-bind:for="`zipcode-${index + lngth + 1}`"/>
                            <x-main::input.text x-bind:id="`zipcode-${index + lngth + 1}`"
                                                x-bind:name="`seo[schema][jobPositions][${index + lngth + 1}][zipcode]`"
                                                class="block w-full"/>
                        </div>
                    </div>

                </fieldset>
            </template>
            <div>
                <x-main::button.primary type="button" role="button" title="{{__('add title')}}" id="addQuestion"
                                        @click="addNewField()">
                    {{__('add')}}
                </x-main::button.primary>

            </div>
        </div>
    </div>
</section>
