@props(['open'=>true ,'multiple'=>false,'key','label' ,'dataLabel' ,'dataValue' ,'dataSearch' ,'url','model' , 'selected'=>[]])
@php
$random=\Illuminate\Support\Str::random(3).rand(10,1000);
$data=old('extra.'.$key) ??  $instance?->getMeta($key)  ?? $selected ?? [];
$items=(new $model)->query()->whereIn('id',$data)->select(['id' ,'title'])->get();
@endphp
<x-main::accordion.single :title="$label" :open="$open">
    <x-main::input.select :multiple="$multiple" id="model_id_{{$random}}" class="block w-full get-by-ajax border-none !py-0 !px-0" name="extra[{{$key}}][]"
        data-value-field="{{$dataValue}}" data-label-field="{{$dataLabel}}" data-search-field="{{$dataSearch}}" data-url="{{$url}}">
        @foreach($items as $item)
            <option value="{{$item->id ?? $item['id']}}" selected>{{$item->title ?? $item['title']}}</option>
        @endforeach

    </x-main::input.select>
    <x-main::input.error :messages="$errors->get($key)" class="mt-2"/>
</x-main::accordion.single>

