@props(['accordion'=>true,'open'=>true ,'multiple'=>false,'label' ,'dataLabel' ,'dataValue' ,'dataSearch' ,'name' ,'url'])
@php($random=\Illuminate\Support\Str::random(3).rand(10,1000))


<x-main::accordion.single :title="$label" :open="$open" :accordion="$accordion">
    <x-main::input.select :multiple="$multiple" id="model_id_{{$random}}" class="block w-full get-by-ajax border-none !py-0 !px-0" name="{{$name}}"
        data-value-field="{{$dataValue}}" data-label-field="{{$dataLabel}}" data-search-field="{{$dataSearch}}" data-url="{{$url}}">
        @isset($instance)
          @if(is_array($instance) || $instance instanceof \Illuminate\Support\Collection)
                @foreach($instance as $related)
                    <option value="{{$related->id ?? $related['id']}}" selected>{{$related->title ?? $related['title']}}</option>
                @endforeach
           @else
                <option value="{{$instance->id ?? $instance['id']}}" selected>{{$instance->title ?? $instance['title']}}</option>

            @endif
        @endisset
    </x-main::input.select>
    <x-main::input.error :messages="$errors->get($name)" class="mt-2"/>
</x-main::accordion.single>

