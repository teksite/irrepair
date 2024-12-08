@props(['open'=>true])
@php
   $preTags =old('tags') ?? (isset($instance) && $instance->tags ? $instance->tags->pluck('title')->toArray() : []) ?? [] ;
   $tags=collect($preTags)->merge(\Modules\Main\Models\Tag::all()->pluck('title')->toArray())->unique()
@endphp
<div>
    <x-main::accordion.single :title="__('tags')" :open="$open">
        <x-main::input.select aria-label="{{__('tags')}}" id="tags-box" class="block w-full select-box" name="tags[]" :multiple="true" data-creation="true" data-plugin="remove_button">
            @foreach($tags as $tag)
                <option {{ in_array($tag , $preTags) ? 'selected': ''}}  value="{{$tag}}">
                    {{$tag}}
                </option>
            @endforeach
        </x-main::input.select>
    </x-main::accordion.single>
    <x-main::input.error :messages="$errors->get('tags')" class="mt-2"/>

</div>
