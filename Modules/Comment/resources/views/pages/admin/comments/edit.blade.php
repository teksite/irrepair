<x-main::admin-editor-layout :instance="$comment" method="PATCH">
    @section('title',__('edit :title',['title'=>__('comment')]))
    @section('header-description',__('in this window you can see and edit the :title (:item)',['title'=>__('comment'),'item'=>$comment->title]))
    @section('formRoute',route('admin.comments.update', $comment))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.comments.index')" :title="__('all :title',['title'=>__('comments')])" />
        @can('comment-create')
            @can('comment-create')
                <x-main::link.header :href="route('admin.comments.show',$comment)" :title="__('reply to :title',['title'=>__('comment')])" />
            @endcan
        @endcan
    @endsection
    @section('hero-end-section')
        @can('comment-delete')
            <x-main::link.delete :route="route('admin.comments.destroy' , $comment)" title="{{$comment->title}}"/>
        @endcan
    @endsection
    @section('main')
        <x-main::box>
            <x-main::table>
                <tr>
                    <th class="text-start p-3">
                        {{__('page')}}
                    </th>
                    <td class="p-3 flex items-center gap-6">
                        {{$comment->model->title}}
                        <a href="{{$comment->model->path()}}" target="_blank">
                            <i class="tkicon icon fill-none stroke-blue-600" data-icon="eye"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th class="text-start p-3">
                        {{__('author')}}
                    </th>
                    <td class="p-3 flex items-center gap-3">
                        {{$comment?->user?->name ?? $comment->name}}
                        @if($comment->user_id)
                            @if(Route::has('users.show'))
                                <a href="{{$comment->user->path()}}" class="bg-blue-600 rounded-full p-0.5" target="_blank">
                                    <i class="tkicon fill-none stroke-white p-1 rounded-full" size="14" data-icon="tick"></i>
                                </a>
                            @else
                                <i class="tkicon fill-none stroke-white bg-blue-600 p-1 rounded-full" size="14" data-icon="tick"></i>
                            @endif
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="text-start p-3">
                        {{__('email')}}
                    </th>
                    <td class="p-3">
                        {{$comment?->user?->email ?? $comment->email}}
                    </td>
                </tr>
                <tr>
                    <td class="p-3" colspan="2">
                        <x-main::input.textarea rows="6" name="message" class="block w-full">{{$comment->message}}</x-main::input.textarea>
                        <x-main::input.error :messages="$errors->get('message')" class="mt-2"/>
                    </td>
                </tr>
                <tr>
                    <th class="text-start p-3">
                        {{__('ip')}}
                    </th>
                    <td class="p-3">
                        {{$comment->ip_address}}

                    </td>
                </tr>

            </x-main::table>

        </x-main::box>
        @if($bloodline->count())
            <div>
                <h3 class="mb-3">
                    {{__('comment line')}}
                </h3>
                <ul class="space-y-1">
                    @foreach($bloodline as $cmnt)
                        <li class="p {{$cmnt->id ==$comment->id ? 'font-bold' :''}}">
                            <div class="flex items-center gap-3">
                           <span class="border border-slate-600 rounded-full aspect-square min-w-fit w-6 p-1 text-center {{$cmnt->confirmed ? 'bg-green-600' :'bg-yellow-600'}}">
                               {{$loop->index + 1}}
                           </span>
                                <p class="!mb-0">
                                    {{$cmnt->message}}
                                </p>
                                @if($cmnt->id !=$comment->id )
                                <span class="{{$cmnt->confirmed ? 'text-green-600' :'text-yellow-600'}} text-sm">
                                       {{$cmnt->confirmed ? __('confirmed') : __('pending')}}
                                </span>
                                    <x-main::link.edit :route="route('admin.comments.edit',$cmnt)" title="{{$cmnt->title}}"/>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endsection
    @section('aside')
        @include('comment::layouts.admin.sections.confirmation' ,['open'=>'true' ,'title'=>'confirmation','instance'=>$comment])
    @endsection


</x-main::admin-editor-layout>
