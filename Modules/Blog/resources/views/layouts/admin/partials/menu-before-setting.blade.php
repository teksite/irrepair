@can('post-read')
    <x-main::accordion.nav :title="__('blog')" icon="paper-text" class="" :active="request()->routeIs('admin.blog.*')">
        @can('post-category-read')
        <x-main::accordion.link href="{{route('admin.blog.posts.index')}}" :title="__('all :title',['title'=>__('posts')])" :active="request()->routeIs('admin.blog.posts.index')">
            {{__(':title list',['title'=>__('posts')])}}
        </x-main::accordion.link>
        @endcan
    @can('post-category-read')
        <x-main::accordion.link href="{{route('admin.blog.categories.index')}}" :title="__('all :title',['title'=>__('categories')])" :active="request()->routeIs('admin.blog.categories.index')">
            {{__(':title list',['title'=>__('categories')])}}
        </x-main::accordion.link>
        @endcan
        @can('article-read')

        <x-main::accordion.link href="{{route('admin.blog.articles.index')}}" :title="__('all :title',['title'=>__('articles')])" :active="request()->routeIs('admin.blog.articles.index')">
            {{__(':title list',['title'=>__('articles')])}}
        </x-main::accordion.link>
         @endcan

          @can('post-edit')
              <x-main::accordion.link href="{{route('admin.blog.pinned.index')}}"  :title="__('pinned posts')" :active="request()->routeIs('admin.blog.pinned.index')">
                  {{__('pinned posts')}}
              </x-main::accordion.link>
          @endcan
    </x-main::accordion.nav>
@endcan
