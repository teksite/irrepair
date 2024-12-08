
<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="Article" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="Article" class="hidden"  type="hidden"/>
    <div class="mb-3 md:w-1/2">
        <x-main::input.label value="{{__('specific type')}}" for="seo_type_specific"/>
        <x-main::input.select id="seo_type_specific" name="seo[schema][type]" class="block w-full mb-3">
            @foreach(config('global.seoschematype.pageType.Article') as $key=>$description)
                <option value="{{$key}}" {{isset($schema['type']) && $schema['type'] ==$key ? 'selected':''}}>
                    <span class="font-bold">{{__($key)}}</span>
                </option>
            @endforeach
        </x-main::input.select>
        <x-main::input.error :messages="$errors->get('seo.schema.type')"/>
    </div>
    <div class="mb-3">
        <x-main::input.label value="{{__('headline')}}" for="schema_headline"/>
        <x-main::input.text id="schema_headline" name="seo[schema][headline]" class="block w-full mb-3"
                      value="{{$schema['headline'] ?? ''}}"/>
        <x-main::input.error :messages="$errors->get('seo.schema.headline')"/>
    </div>
    <div class="mb-3 ">
        <x-main::input.label value="{{__('schema description')}}" for="schema_description"/>
        <x-main::input.textarea id="schema_description" name="seo[schema][description]"
                          class="block w-full mb-3">{{$schema['description'] ?? ''}}</x-main::input.textarea>
        <x-main::input.error :messages="$errors->get('seo.schema.description')"/>
    </div>
    <div class="mb-3 grid gap-3 md:grid-cols-3">
        <div>
            <x-main::input.label value="{{__('author type')}}" for="schema_authorType"/>
            <x-main::input.select id="schema_authorType" name="seo[schema][authorType]" class="block w-full mb-3">
                <option
                    value="Person" {{isset($schema['authorType']) && $schema['authorType'] =='Person' ? 'selected': ''}}>
                    {{__('person')}}
                </option>
                <option
                    value="Organization" {{isset($schema['authorType']) && $schema['authorType'] =='Organization' ? 'selected' : ''}}>
                    {{__('organization')}}
                </option>
            </x-main::input.select>
            <x-main::input.error :messages="$errors->get('seo.schema.authorType')"/>
        </div>
        <div>
            <x-main::input.label value="{{__('author url')}}" for="schema_authorUrl"/>
            <x-main::input.text type="url" dir="ltr" id="schema_authorUrl" name="seo[schema][authorUrl]" value="{{$schema['authorUrl'] ?? ''}}"
                          class="block w-full mb-3"/>
            <x-main::input.error :messages="$errors->get('seo.schema.authorUrl')"/>
        </div>
        <div>
            <x-main::input.label value="{{__('author name')}}" for="schema_authorName"/>
            <x-main::input.text id="schema_authorName" name="seo[schema][authorName]"
                          value="{{$schema['authorName'] ?? ''}}" lass="block w-full mb-3"/>
            <x-main::input.error :messages="$errors->get('seo.schema.authorName')"/>
        </div>
    </div>
    <div class="mb-3 grid gap-3 md:grid-cols-3">
        <div>
            <x-main::input.label value="{{__('publisher name')}}" for="schema_publisherName"/>
            <x-main::input.text id="schema_publisherName" name="seo[schema][publisherName]"
                          value="{{$schema['publisherName'] ?? ''}}" class="block w-full mb-3"/>
            <x-main::input.error :messages="$errors->get('seo.schema.publisherName')"/>
        </div>
        <div>
            <x-main::input.label value="{{__('publisher logo url')}}" for="schema_publisherLogo"/>
            <x-main::input.text dir="ltr" type="url" id="schema_publisherLogo" name="seo[schema][publisherLogo]"
                          value="{{$schema['publisherLogo'] ?? ''}}" class="block w-full mb-3"/>
            <x-main::input.error :messages="$errors->get('seo.schema.publisherLogo')"/>
        </div>
    </div>
    <div class="mb-3 grid gap-3 md:grid-cols-2">
        <div>
            <x-main::input.label value="{{__('image url')}}" for="schema_image"/>
            <x-main::input.text type="url" dir="ltr" id="schema_image" name="seo[schema][image]" value="{{$schema['image'] ?? ''}}"
                          placeholder="{{__('leave it empty to read from featured image')}}"
                          class="block w-full mb-3" onchange="document.getElementById('image_preview_article_schema').src=this.value"/>
        </div>
        <input type="text" >
        <div>
            <img src="{{$schema['image'] ?? ''}}" height="400" width="400" id="image_preview_article_schema" alt="">
        </div>
    </div>

</section>
