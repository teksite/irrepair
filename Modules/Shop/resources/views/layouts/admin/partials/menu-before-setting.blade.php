@canany(['product-read','product-category-read'])
    <x-main::accordion.nav :title="__('products')" icon="shop" class="" :active="request()->routeIs('admin.shop.*')">
        @can('product-read')
            <x-main::accordion.link href="{{route('admin.shop.products.index')}}" :title="__('new :title',['title'=>__('page')])"
                                    :active="request()->routeIs('admin.shop.products.index')">
                {{__(':title list',['title'=>__('products')])}}
            </x-main::accordion.link>
        @endcan

        @can('product-category-read')
        <x-main::accordion.link href="{{route('admin.shop.categories.index')}}" :title="__('all :title',['title'=>__('pages')])" :active="request()->routeIs('admin.shop.categories.index')">
            {{__(':title list',['title'=>__('categories')])}}
        </x-main::accordion.link>
        @endcan

        @can('product-read')
            <x-main::accordion.link href="{{route('admin.shop.attributes.index')}}" :title="__('new :title',['title'=>__('attribute')])"
                                    :active="request()->routeIs('admin.shop.attributes.index')">
                {{__(':title list',['title'=>__('attributes')])}}
            </x-main::accordion.link>
        @endcan
    </x-main::accordion.nav>
@endcanany

@can('product-read')
    <x-main::accordion.nav :title="__('sell')" icon="coin-dollar" class="" :active="request()->routeIs('admin.sell.*')">
        @can('product-read')
            <x-main::accordion.link href="{{route('admin.sell.orders.index')}}" :title="__('all :title',['title'=>__('orders')])"
                                    :active="request()->routeIs('admin.sell.orders.index')">
                {{__(':title list',['title'=>__('orders')])}}
            </x-main::accordion.link>
     
            <x-main::accordion.link href="{{route('admin.sell.analytics.show')}}" :title="__('analytics')" :active="request()->routeIs('admin.sell.analytics.show')">
                {{__('analytics')}}
            </x-main::accordion.link>
        @endcan
    </x-main::accordion.nav>
@endcan

