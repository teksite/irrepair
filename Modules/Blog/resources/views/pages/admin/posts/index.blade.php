<x-main::admin-list-layout>
        @section('title' , __(':title list',['title'=>__('posts')]))
        @section('header-description' , __("in this window you can see all :title", ['title'=>__('posts')]))

        @section('hero-start-section')
            @can('post-create')
                <x-main::link.header :title="__('new :title',['title' =>__('post')])" :href="route('admin.blog.posts.create')"/>
            @endcan
                @can('post-delete')
                    <x-main::link.trash :route="route('admin.blog.posts.trash.index')" count="{{$trashCount}}"/>
                @endcan
        @endsection
        @section('hero-end-section')
            <x-main::search/>
        @endsection

    @section('main')

        <x-main::box>
            <x-main::table :header="['id'=>'#','image' ,'title'=>'title' ,'status'=>'status','created_at'=>'created at','published_at'=>'published at',]">
                @if($posts->count())
                    @foreach($posts as $key=>$post)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$posts->firstItem() + $key}}</td>
                            <td class="p-3"><img src="{{$post->featured_image}}" alt="{{$post->title}}" width="150" height="50"></td>
                            <td class="p-3">{{$post->title}}</td>
                            <td class="p-3">{{$post->status->value}}</td>
                            <td class="p-3">{{$post->created_at}}</td>
                            <td class="p-3">{{$post->published_at}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('post-edit')
                                        <x-main::link.edit :route="route('admin.blog.posts.edit' , $post)" title="{{$post->title}}"/>
                                    @endcan
                                        <x-main::link.show :route="route('admin.blog.posts.show' , $post)" title="{{$post->title}}"/>

                                    @can('post-delete')
                                        <x-main::link.delete :route="route('admin.blog.posts.destroy' , $post)" title="{{$post->title}}"/>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="p-3">
                            <p class="text-center">
                                {{__('no item has been found')}}
                            </p>
                        </td>
                    </tr>
                @endif
                @if($posts?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$posts->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

