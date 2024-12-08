<x-main::admin-credix-layout>
    @push('headerScripts')
        @vite(['Modules/Blog/resources/assets/css/app.css', 'Modules/Blog/resources/assets/js/app.js'])
    @endpush
    @section('title',__('pinned posts'))
    @section('header-description',__('in this window you can see all :title and create new one',['title'=>__('pinned posts')]))

    @section('formRoute' ,route('admin.blog.pinned.store'))

    @section('form')
        <div class="mb-6">
            @include('main::layouts.admin.sections.get-models',['accordion'=>false,'open'=>"true" ,'multiple'=>true,'label'=>__('posts') ,'dataLabel'=>'title' ,'dataValue'=>'id' ,'dataSearch'=>'title' ,'name'=>'posts[]' ,'url'=>route('admin.ajax.blog.posts.get') ])
        </div>
    @endsection

    @section('index')
        <div class="container md:col-span-4" id="menuLists">
            <form method="POST" action="{{route('admin.blog.pinned.update')}}">
                @csrf
                @method('PATCH')
                <ul class="nested list-none space-y-6">
                    @foreach($posts as $post)
                        <li id="parent_{{$post->id}}">
                            <x-main::box class="flex gap-3 items-center">
                                <span class="handle self-stretch px-2 py-1 bg-gray-400 cursor-all-scroll">✢</span>
                                <span class="w-full">
                                    {{$post->title}}
                                </span>
                                <button type="button" role="button" class="text-red-700 font-bold deleteItemBtn" data-target="parent_{{$post->id}}">
                                    X
                                </button>
                                <input type="hidden" name="posts[{{$post->id}}]" value="{{$post->pinned}}" class="item_id ">
                            </x-main::box>
                        </li>
                    @endforeach
                </ul>
                <div class="my-3 w-full flex justify-end items-center">
                    <x-main::button.primary>
                        {{__('update')}}
                    </x-main::button.primary>
                </div>
            </form>
        </div>
    @endsection

</x-main::admin-credix-layout>

