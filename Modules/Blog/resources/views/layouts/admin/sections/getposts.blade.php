@props(['name'=>'extra[posts]'])
@once
    @push('headerScripts')
        @vite(['Modules/Blog/resources/assets/css/app.css', 'Modules/Blog/resources/assets/js/app.js'])
    @endpush
@endonce
@php
    $random=rand(10 , 100);
        $posts=[];
        if ($instance && $instance?->meta() ){
            $postsArray=$instance->meta()->where('key','posts')->first()?->value;
            if($postsArray){
                $posts=\Modules\Blog\Models\Post::query()->whereIn('id',$postsArray)->select(['id','title'])->get();
             }
        }
@endphp
<div>
    <x-main::input.label for="relative_post_{{$random}}" :value="__('posts')"/>
    <x-main::input.select :multiple="true" id="relative_user_{{$random}}" class="block w-full related_post" name="{{$name}}[]">
        @foreach($posts as $post)
            <option value="{{$post->id}}" selected>
                {{$post->title}}
            </option>
        @endforeach
    </x-main::input.select>
    <x-main::input.error :messages="$errors->get('posts')" class="mt-2"/>
    <x-main::input.error :messages="$errors->get('posts.*')" class="mt-2"/>

</div>
