@props(['open'=>true])
<x-main::accordion.single :title="__('article')" :open="$open">
    <x-main::input.select id="article_id" class="block w-full" name="article_id">
        <option value="" {{isset($instance) && $instance->article_id == null ? 'selected' : ''}} >
            {{__('none')}}
        </option>
            @foreach(\Modules\Blog\Models\Article::all() as $article)
                <option value="{{$article->id}}" {{isset($instance) && $instance->article_id == $article->id ? 'selected' : ''}} >
                    {{$article->title}}
                </option>
            @endforeach
    </x-main::input.select>
    <x-main::input.error :messages="$errors->get('article_id')" class="mt-2"/>
</x-main::accordion.single>
