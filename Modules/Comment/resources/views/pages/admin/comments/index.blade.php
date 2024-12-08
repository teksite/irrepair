<x-main::admin-list-layout>
    @section('title' , __(':title list',['title'=>__('comments')]))
    @section('header-description' , __("in this window you can see all :title", ['title'=>__('comments')]))

    @section('hero-start-section')
          @can('comment-delete')
            <x-main::link.trash :route="route('admin.comments.trash.index')" count="{{$trashCount}}"/>
        @endcan
    @endsection
    @section('hero-end-section')
        <x-main::search/>
    @endsection

    @section('main')

        <x-main::box>

            <x-main::table>
                @if($comments->count())
                    @foreach($comments as $comment)
                        <tr class="group hover:bg-slate-100">
                            <td class="p-3">
                                <div class="flex justify-between items-center gap-6 mb-3">
                                    <div class="flex justify-start items-center gap-3">
                                        <span class="text-sm">{{__('page')}} :</span>
                                        <span class="font-bold">{{$comment->model->title}}</span>
                                        <span class="invisible group-hover:visible">
                                                <x-main::link.show :route="$comment->model->path()"
                                                                   title="{{$comment->model->title}}"/>
                                            </span>
                                    </div>
                                    <div>
                                        <div class="flex gap-3 items-center justify-end invisible group-hover:visible">
                                            <x-main::link.reply :route="route('admin.comments.show' , $comment)"
                                                                title="{{__('comment')}}"/>
                                            @can('comment-edit')
                                                <x-main::link.edit :route="route('admin.comments.edit' , $comment)"
                                                                   title="{{__('comment')}}"/>
                                            @endcan
                                            @can('comment-delete')
                                                <x-main::link.delete :route="route('admin.comments.destroy' , $comment)"
                                                                     title="{{__('comment')}}"/>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                <div class="p">
                                    {{$comment->message}}
                                </div>
                                <hr class="my-1 w-11/12">
                                <div class="flex justify-start items-center gap-6 mb-3">
                                    <div class="flex items-center gap-1 pt-1 text-xs">
                                        <span>{{__('author')}}:</span>
                                        <span>{{$comment->user->name ?? $comment->name ?? '--unknown--'}}</span>
                                    </div>
                                    <div class="flex items-center gap-3 pt-1 text-xs">
                                        <span
                                            class="{{$comment->confirmed ? 'text-green-600' :'text-yellow-600'}} text-sm">
                                         {{$comment->confirmed ? __('confirmed') : __('pending')}}
                                     </span>
                                    </div>
                                    <div class="flex items-center gap-1 pt-1 text-xs">
                                        <span>{{__('created at')}}:</span>
                                        <span>{{$comment->created_at}}</span>
                                    </div>
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
                @if($comments?->links())
                    <x-slot:foot>
                        <tr>
                           <td>
                               @include('main::layouts.admin.sections.delete-all',['route'=>route('admin.comments.delete.items') ,'options'=>['unconfirmed','all','selected']])
                           </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="p-3">
                                {{$comments->appends($_GET)->links()}}
                            </td>
                        </tr>
                    </x-slot:foot>
                @endif
            </x-main::table>
        </x-main::box>
    @endsection

</x-main::admin-list-layout>

