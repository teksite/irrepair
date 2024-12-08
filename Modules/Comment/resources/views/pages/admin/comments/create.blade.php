<x-main::admin-editor-layout>
    @section('title' , __('reply to :title',['title'=>__('comment')]))
    @section('formRoute',route('admin.comments.store'))
    @section('header-description' , __("in this window you create a new :title" , ["title"=>__('comment')]))
    @section('hero-start-section')
        <x-main::link.header :href="route('admin.comments.index')" :title="__('all :title',['title'=>__('comments')])" />
        @can('comment-edit')
            <x-main::link.header :title="__('edit')" :href="route('admin.comments.edit',$comment)"/>
        @endcan
    @endsection
    @section('hero-end-section')
        @can('comment-delete')
            <x-main::link.delete :route="route('admin.comments.destroy' , $comment)" title="{{$comment->title}}"/>
        @endcan
    @endsection
    @section('main')
        @include('main::layouts.admin.sections.text',['name'=>'message' ,'column'=>'message' ,'title'=>'reply'])

        <div class="hidden">
            <input type="hidden" name="model_type" value="{{$comment->model_type}}">
            <input type="hidden" name="model_id" value="{{$comment->model_id}}">
            <input type="hidden" name="parent_id" value="{{$comment->id}}">
        </div>
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
                    <th class="text-start p-3">
                        {{__('created at')}}
                    </th>
                    <td class="p-3">
                        {{dateAdapter($comment->created_at)}}
                    </td>
                </tr>
                <tr>
                    <td class="p-3" colspan="2">
                        {{$comment->message}}
                    </td>
                </tr>
            </x-main::table>
        </x-main::box>

    @endsection

@section('aside')
        @include('comment::layouts.admin.sections.confirmation' ,['open'=>'true' ,'title'=>'confirmation'])
@endsection


</x-main::admin-editor-layout>
