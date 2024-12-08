<x-main::panel-editor-layout>
    @section('title',__('comments'))
    @section('hero-start')
        <h2>
            {{__('edit :title' ,['title'=>__('comment')])}}
        </h2>
    @endsection

    @section('main')
        <x-main::box>
            <form action="{{route('panel.comments.update',$comment)}}" method="POST">
                @csrf
                @method('PATCH')
                <x-main::table>
                    <tr>
                        <th class="text-start p-3">
                            {{__('page')}}
                        </th>
                        <td class="p-3 flex items-center gap-6 w-full">
                            {{$comment->model->title}}
                            <a href="{{$comment->model->path()}}" target="_blank">
                                <i class="tkicon icon fill-none stroke-blue-600" data-icon="eye"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-start p-3">
                            {{__('message')}}
                        </th>
                        <td class="p-3 w-full">
                            <x-main::input.textarea name="message" class="block w-full">{{\Illuminate\Support\Str::limit($comment->message, 150, $end='...')}}</x-main::input.textarea>
                            <x-main::input.error :messages="$errors->get('message')" class="mt-2"/>

                        </td>
                    </tr>
                    <x-slot name="foot">
                        <tr>
                            <td class="p-3" colspan="2">
                                {{__('time')}}: <span dir="ltr"> {{dateAdapter($comment->created_at)}}</span>
                            </td>
                        </tr>
                    </x-slot>
                </x-main::table>

                <div class="mt-6 flex items-center justify-end">
                    <x-main::button.primary>
                        {{__('update')}}
                    </x-main::button.primary>
                </div>
            </form>
        </x-main::box>

    @endsection


    @section('aside')
        @include('comment::layouts.admin.sections.confirmation' ,['open'=>'true' ,'title'=>'confirmation','instance'=>$comment])
    @endsection


    @section('aside')

    @endsection

</x-main::panel-editor-layout>
