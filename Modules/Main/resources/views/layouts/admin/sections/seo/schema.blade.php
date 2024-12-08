<section>
   <div class="mb-3">
       @php
           $seoSchemaType= old('seo.meta.seo_type')  ?? ($instance->seo->seo_type ?? null)  ?? null
       @endphp
        <input type="hidden" value="{{isset($instance) ? get_class($instance) : ''}}" id="instance">
        <input type="hidden" value="{{isset($instance) ? $instance->id : ''}}" id="instanceId">
        <x-main::input.label value="{{__('type')}}" for="seo_type"/>
        <x-main::input.select id="seo_type" class="block w-full">
            @foreach(config('global.seoschematype.pageType') as $type=>$specificType)
                <option @selected($seoSchemaType === $type) >
                    {{$type}}
                </option>
            @endforeach
        </x-main::input.select>
    </div>
    <hr class="my-6  h-3 border-y border-slate-600">
    <div id="waitEl"></div>
    <div id="schemaDetails"></div>
</section>
