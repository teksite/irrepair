<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('articles')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('articles')]))

    @section('hero-start-section')
        @can('article-create')
            <x-main::link.header :title="__('new :title',['title' =>__('article')])" :href="route('admin.blog.articles.create')"/>
        @endcan
        @can('article-delete')
            <x-main::link.trash :route="route('admin.blog.articles.trash.index')" count="{{$trashCount}}"/>
        @endcan
    @endsection
    @section('hero-end-section')
        <x-main::search/>
    @endsection

    @section('main')

        <x-main::box>
            <x-main::table :header="['id'=>'#' ,'title'=>'title' ,'created_at'=>'created at',]">
                @if($articles->count())
                    @foreach($articles as $key=>$article)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">{{$articles->firstItem() + $key}}</td>
                            <td class="p-3">{{$article->title}}</td>
                            <td class="p-3">{{$article->created_at}}</td>
                            <td class="p-3">
                                <div class="flex items-center justify-end invisible group-hover:visible gap-3">
                                    @can('article-edit')
                                        <x-main::link.edit :route="route('admin.blog.articles.edit' , $article)" title="{{$article->title}}"/>
                                    @endcan
                                    <x-main::link.show :route="route('admin.blog.articles.show' , $article)" title="{{$article->title}}"/>

                                    @can('article-delete')
                                        <x-main::link.delete :route="route('admin.blog.articles.destroy' , $article)" title="{{$article->title}}"/>
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
                @if($articles?->links())
                    <x-slot:foot>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$articles->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

