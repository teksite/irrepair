@php($random=rand(10 , 100))
@once
    @push('headerScripts')
        @vite(['Modules/Blog/resources/assets/css/app.css', 'Modules/Blog/resources/assets/js/app.js'])
    @endpush
@endonce
<div>
    <x-main::input.label for="relative_post_{{$random}}" :value="__('posts')"/>

    <x-main::input.select :multiple="true" id="relative_user_{{$random}}" class="block w-full related_post" name="posts[]"></x-main::input.select>
    <x-main::input.error :messages="$errors->get('posts')" class="mt-2"/>
    <x-main::input.error :messages="$errors->get('posts.*')" class="mt-2"/>

</div>
