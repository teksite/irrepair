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
                                    <i class="tkicon fill-none stroke-gray-400 calender" size="20" data-icon="user" ></i>
                                    {{__('author')}} :
                                </span>
                            <span  class="p text-sm">
                                {{$post->user->nickname ?? $post->user->name}}
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                                 <span class="inline-flex items-center gap-1">
                                    <i class="tkicon fill-none stroke-gray-400 calender" size="20" data-icon="calender" ></i>
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

            <div class="grid gap-12 md:grid-cols-3 xl:grid-cols-4 mb-12">
                <div class="order-2 lg:order-1 md:col-span-3 lg:col-span-1 xl:grid-cols-1">
                    <div class="sticky top-6">
                        <div class="border border-dotted border-slate-200 rounded p-3">
                            <aside class="mb-6">
                                <h2 class="text-lg !mb-1">{{__('last posts')}}</h2>
                                <hr class="my-1">
                                <ul class="grid gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-1 divide-y divide-slate-200">
                                    @foreach(\Modules\Blog\Models\Post::query()->latest()->take(5)->get() as $lastPost)
                                        <li class="py-3">
                                            <figure class="flex flex-col items-center gap-1">
                                                <img src="{{$lastPost->featured_image}}" alt="{{$lastPost->title}}"
                                                     width="100" height="50">
                                                <figcaption class="text-center">
                                                    <a href="{{$lastPost->path()}}" class="link-regular text-sm">
                                                        {{$lastPost->title}}
                                                    </a>
                                                </figcaption>
                                            </figure>
                                        </li>

                                    @endforeach

                                </ul>
                            </aside>
                        </div>
                        <aside class="my-12 mb-6">
                            <div class="border-2 border-slate-200 rounded-lg p-3 relative">
                                <h5 class="text-sm bg-white px-3 py-1 absolute start-1.5 -top-5 z-10 border border-transparent rounded">
                                    {{__('request a demo')}}
                                </h5>
                                <div
                                    class="rounded bg-primary-900 p-3 overflow-hidden relative group transition-all duration-700 h-12">
                                    <a href="/demo-request"
                                       class="text-gray-200 font-bold flex items-center gap-6 absolute top-1/2 start-1.5 z-20 -translate-y-1/2">
                                        <i class="tkicon fill-none stroke-current" size="32" data-icon="demo"></i>
                                        <span>
                                        {{__('link of the form')}}
                                    </span>
                                    </a>
                                    <div class="transition-all duration-700 ease-in-out bg-secondary-600 h-full w-0 group-hover:w-full absolute z-10 top-0 start-0"></div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
                <main class="order-1 lg:order-2 md:col-span-3 lg:col-span-2 xl:col-span-3 p blog-post" id="bodyArticle">
                    <div>
                        @if( $post->except)
                        <div class="mb-6">
                            {!! $post->except !!}
                        </div>
                        @endif
                        <x-content-list/>
                        {!! $post->body !!}
                    </div>
                </main>
            </div>
            <x-share.share :url="$post->path()" :text="$post->title" :qrcode="$svg"/>
                <x-comment.comment-section :model="$post"/>
        </div>
    </article>
</x-client-layout>
