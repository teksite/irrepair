@props(['open'=>true])

@php
    $categories=\Modules\Blog\Models\Category::query()->where('parent_id',0)->get()->map(function ($category) {
                   return $category->descendantsAndSelf()->orderBy('title')->get();
                    })->flatten();
@endphp

<x-main::accordion.single :title="__('categories')" :open="$open">
    <x-main::input.select id="categories" class="block w-full" name="categories[]">
        @foreach($categories as $category)
            <option
                value="{{$category->id}}" {{isset($instance) && in_array($category->id , $instance->categories()->pluck('id')->toArray()) ? 'selected' : ''}} >
                {{$category->title}}
            </option>
        @endforeach
    </x-main::input.select>
    <x-main::input.error :messages="$errors->get('categories')" class="mt-2"/>
</x-main::accordion.single>
