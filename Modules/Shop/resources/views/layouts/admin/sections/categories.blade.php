@props(['open'=>true])

@php
    $categories=\Modules\Shop\Models\Category::query()->select(['id','title'])->get();
@endphp

<x-main::accordion.single :title="__('categories')" :open="$open">
    <x-main::input.select id="categories" class="block w-full" name="category_id">
        @foreach($categories as $category)
            <option
                value="{{$category->id}}" {{isset($instance) && $category->id === $instance->category_id ? 'selected' : ''}} >
                {{$category->title}}
            </option>
        @endforeach
    </x-main::input.select>
    <x-main::input.error :messages="$errors->get('categories')" class="mt-2"/>
</x-main::accordion.single>
