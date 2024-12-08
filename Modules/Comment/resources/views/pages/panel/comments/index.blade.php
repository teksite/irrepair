<x-main::panel-editor-layout>
    @section('title',__('comments'))
    @section('hero-start')
        <h2>
            @if(!request()->status)
                {{__('all :title',['title'=>__('comments')])}}
            @elseif(request()->status =='seen')
                {{__('confirmed :title',['title'=>__('comments')])}}
            @elseif(request()->status)
                {{__('pending :title',['title'=>__('comments')])}}
            @endif
        </h2>
    @endsection

    @section('main')
        @if($comments->count())
            <ul class="gap-6 mb-6 grid lg:grid-cols-2">
                @foreach($comments as $comment)
                    <li class="group">
                        <x-main::box>
                            <div class="flex justify-between items-center gap-6 mb-3">
                                <div class="flex justify-start items-center gap-3">
                                    <span class="text-sm">{{__('page')}} :</span>
                                    <span class="font-bold">{{$comment->model->title}}</span>
                                    <span class="invisible group-hover:visible">
                                        <x-main::link.show :route="$comment->model->path()" title="{{$comment->model->title}}"/>
                                    </span>
                                </div>
                                <div>
                                    <div class="flex gap-3 items-center justify-end invisible group-hover:visible">

                                        @if (now() < \Carbon\Carbon::parse($comment->created_at)->addMinutes(config('sitesetting.comment_edit_until',120)) && !$comment->confirmed)

                                            @can('client-comment-edit')
                                                <x-main::link.edit :route="route('panel.comments.edit' , $comment)"  title="{{__('comment')}}"/>
                                            @endcan
                                        @endif

                                        @if (now() < \Carbon\Carbon::parse($comment->created_at)->addMinutes(config('sitesetting.comment_delete_until',120)) && !$comment->confirmed)
                                            @can('client-comment-delete')
                                            <x-main::link.delete :route="route('panel.comments.destroy',$comment)" title="{{__('comment')}}"/>
                                            @endcan
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="p">
                                {{$comment->message}}
                            </div>
                            <hr class="my-1 w-11/12">
                            <div class="flex justify-start items-center gap-6 mb-3">
                                <div class="flex items-center gap-3 pt-1 text-xs">
                                        <span class="{{$comment->confirmed ? 'text-green-600' :'text-yellow-600'}} text-sm">
                                         {{$comment->confirmed ? __('confirmed') : __('pending')}}
                                     </span>
                                </div>
                                <div class="flex items-center gap-1 pt-1 text-xs">
                                    <span>{{__('created at')}}:</span>
                                    <span dir="ltr">{{dateAdapter($comment->created_at)}}</span>
                                </div>
                            </div>

                        </x-main::box>
                    </li>
                @endforeach
            </ul>

            <div class="p">
                {{$comments->appends($_GET)->links()}}
            </div>
        @endif

    @endsection

</x-main::panel-editor-layout>
