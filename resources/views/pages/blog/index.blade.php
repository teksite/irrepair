<x-client-layout :seo="$seo">
    <x-slot name="editAddressPage">{{route('admin.blog.posts.index')}}</x-slot>
    <main>
        <h1 class="text-center mt-24">{{__('blog')}}</h1>

            <section class="inner-container mb-24 flex items-center">
                <div>
                    <h2>
                        {{__('important posts')}}
                    </h2>
                    <div class="grid gap-6 lg:grid-cols-2 ">
                        <div>
                            <figure class="text-center relative flex justify-between flex-col gap-3 !mb-0">
                                <img src="{{$pinnedPosts->take(1)->first()->featured_image}}" alt="{{$pinnedPosts->take(1)->first()->title}}"
                                     fetchpriority="high" decoding="sync" width="1200" height="400" class="w-full h-auto rounded-lg" loading="eager">
                                <figcaption class="!mb-0">
                                    <a href="{{$pinnedPosts->take(1)->first()->path()}}"
                                       class="font-bold text-center regular">
                                        {{$pinnedPosts->take(1)->first()->title}}
                                    </a>
                                </figcaption>
                                <i class="tkicon fill-gray-200 absolute -z-10 -start-6 -top-8" view-box="0 0 67 67" size="67" data-icon="circle-texture"></i>

                            </figure>
                        </div>
                        <div>
                            <ul class="flex flex-col gap-6 justify-between divide-y">
                                @foreach($pinnedPosts as $pinnedPost)
                                    @if($loop->index == 0)
                                        @continue
                                    @endif
                                    <li>
                                        <article class="flex items-center gap-3 p-3">
                                            <img src="{{$pinnedPost->featured_image}}" alt="{{$pinnedPost->title}}"
                                                 width="150" height="100" class="rounded-lg" loading="lazy"
                                                 fetchpriority="high" decoding="sync">
                                            <div class="w-full">
                                                <header>
                                                    <h3 class="text-sm !mb-0">
                                                        {{$pinnedPost->title}}
                                                    </h3>
                                                </header>
                                                <footer class="text-end">
                                                    <a href="{{$pinnedPost->path()}}"
                                                       class="regular my-6 font-bold text-sm">
                                                        {{__('read')}}
                                                    </a>
                                                </footer>
                                            </div>
                                        </article>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        <section class="mb-24">
            <div class="bg-zinc-900">
                <div class="bg-no-repeat bg-cover bg-fixed bg-theme-4 pb-24 pt-24">
                    <div class="inner-container p-3">
                        <h2 class="text-white text-4xl text-center">
                            {{__('categories')}}
                        </h2>
                        <hr class="border-secondary-700 mt-6 mb-12">

                        <nav>
                            <ul class="gap-12 grid md:grid-cols-2 lg:grid-cols-3">
                                <li class="">
                                    <a href="{{request()->fullUrlWithoutQuery('categories')}}"
                                       class="rounded-lg p-3 bg-primary-950 w-full h-full flex items-center justify-center text-gray-200 ring-2 ring-blue-600 ring-offset-2 ring-offset-slate-500">
                                        {{__('all')}}
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    @if($category->posts()->count())

                                    <li class="">
                                        <a href="{{route('posts.index')}}/?categories={{$category->title}}#posts"
                                           class="rounded-lg p-3 bg-primary-950 w-full h-full flex items-center justify-center text-gray-200 ring-2 ring-blue-600 ring-offset-2 ring-offset-slate-500">
                                            {{$category->title}}
                                        </a>
                                    </li>
                                    @endif

                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="inner-container mb-24">
            <h2 class="text-center mb-24" id="posts">
                {{request()->categories ? request()->categories :__('posts')}}
            </h2>
            <ul class="grid gap-6 md:grid-cols-2 xl:grid-cols-4" id="all-posts">
                @foreach($posts as $post)
                    <li>
                        <x-box class="!p-0 h-full overflow-hidden relative">
                            <article class="flex flex-col justify-between h-full">
                                <header>
                                    <img src="{{$post->featured_image}}" alt="{{$post->title}}" width="600" height="300"
                                         class="w-full h-auto mb-6" loading="lazy" fetchpriority="low" decoding="async">
                                    <h3 class="text-base text-center px-3 !mb-0">
                                        <a href="{{$post->path()}}">{{$post->title}}</a>
                                    </h3>
                                </header>
                                <hr class="my-6">
                                <footer class="text-end px-3 py-1">
                                    <div class="flex items-center justify-between gap-3">
                                        <span
                                            class="text-gray-700 text-xs relative z-10">
                                            {{$post->categories->first()->title}}
                                        </span>
                                        <a href="{{$post->path()}}" title="{{__('visit :title',['title'=>$post->title])}}" class="regular font-bold text-xs p-1">
                                            {{__('read')}}
                                        </a>
                                    </div>
                                </footer>
                            </article>
                            <span
                                class="bottom-0 start-0 w-1/2 h-16 rounded-e-full absolute bg-gray-200  translate-y-1/2 -z-1 p-1"></span>
                        </x-box>
                    </li>
                @endforeach
            </ul>
            <div class="my-6">
                {!! $posts->appends($_GET)->links() !!}
            </div>
        </section>
    </main>
</x-client-layout>
