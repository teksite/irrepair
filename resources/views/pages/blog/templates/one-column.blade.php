<x-client-layout :seo="$seo">
    <x-slot name="editAddressPage">{{route('admin.blog.posts.edit',$post)}}</x-slot>

    <article>
        <div class="inner-container my-12">
            <h1>
                {{$post->title}}
            </h1>
            <x-breadcrumb :items="$post->breadcrumb()" class="text-sm p -mt-3 mb-6"/>
            <header class="border border-dotted border-slate-200 rounded mb-12">
                @if($post->featured_image)
                    <div class="">
                        <img src="{{$post->featured_image}}" alt="{{$post->title}}" width="1200" height="900"
                             id="primaryImage" class="w-full object-cover" fetchpriority="high" decoding="sync">
                    </div>
                @endif
                <div class="border-2 rounded-lg border-slate-200 p-3">
                    <ul class="p p-3 space-y-3 md:columns-2 lg:columns-4">
                        <li class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1">
                                    <i class="tkicon fill-none stroke-gray-400 calender" size="20" data-icon="user"></i>
                                    {{__('author')}} :
                                </span>
                            <span class="p text-sm">
                                {{$post->user->nickname ?? $post->user->name}}
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                                 <span class="inline-flex items-center gap-1">
                                    <i class="tkicon fill-none stroke-gray-400 calender" size="20"
                                       data-icon="calender"></i>
                                    {{__('published date')}} :
                                </span>
                            <span class="p" dir="ltr">
                                    {{dateAdapter($post->published_at ?? $post->created_at  ,'Y-m-d')}}
                                </span>
                        </li>
                        <li class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1">
                                    <i class="tkicon fill-none stroke-gray-400" size="20" data-icon="folder-open"></i>
                                    {{__('categories')}}:
                                </span>
                            {{$post->categories->pluck('title')->implode(', ')}}
                        </li>
                        <li class="flex items-center gap-3">
                               <span class="inline-flex items-center gap-1">
                                    <i class="tkicon fill-none stroke-gray-400" size="20" data-icon="tag"></i>
                                    {{__('tags')}}:
                                </span>
                            @foreach($post->tags as $tag)
                                <a href="{{route('search',['s'=>$tag->title , 'in'=>'posts'])}}"
                                   class="text-sm p underline decoration-dotted underline-offset-3 hover:decoration-solid">
                                    {{$tag->title}}
                                </a>
                                {{$loop->last ? '': ','}}
                            @endforeach
                        </li>
                    </ul>
                </div>
            </header>

            <main class="p" id="bodyArticle">
                <div class="mb-6">
                    {!! $post->except !!}
                </div>
                <x-content-list/>
                {!! $post->body !!}


                <div>
                    <x-share.share :url="$post->path()" :text="$post->title" :qrcode="$svg"/>

                </div>
            </main>
            <section class="mb-6">
                <h2 class="text-lg">{{__('last posts')}}</h2>

                <ul class="grid gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5  divide-y divide-slate-200">
                    @foreach(\Modules\Blog\Models\Post::query()->latest()->take(5)->get() as $lastPost)
                        <li>
                            <figure class="text-center">
                                <img src="{{$lastPost->featured_image}}" alt="{{$lastPost->title}}" width="400"
                                     height="200" class="mx-auto">
                                <figcaption>
                                    <a href="{{$lastPost->path()}}"
                                       class="text-sm regular mx-auto text-center ">
                                        {{$lastPost->title}}
                                    </a>
                                </figcaption>
                            </figure>
                        </li>

                    @endforeach

                </ul>
            </section>

            {{--        @if(\Nwidart\Modules\Facades\Module::isAvailable('Comment'))--}}
            {{--                <x-comment.comment-section :model="$post"/>--}}
            {{--            @endif--}}
        </div>
    </article>
</x-client-layout>
