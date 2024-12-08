@can('form-receive-read')
    <x-main::box>
        <h3 class="text-center mb-3">
            {{__('forms')}}
        </h3>
        <table class="w-full text-center">
            <thead>
            <tr>
                <th>{{__('title')}}</th>
                <th>{{__('all')}}</th>
                <th>{{__('unread')}}</th>
            </tr>
            </thead>
            @foreach(\Modules\Form\Models\Form::query()->select(['id','title'])->withCount([
            'inboxes',
            'inboxes as unread_count' => function ($query) {
            $query->whereNull('read_at');
                }
            ])->get() as $form )

                <tbody>
                <tr>
                    <td class="font-bold p-2">
                        <a class="regular" href="{{route('admin.forms.inboxes.index', ['form'=>$form])}}">{{$form->title}}</a>
                    </td>
                    <td class="p-2">{{$form->inboxes_count}}</td>
                    <td class="font-bold p-2">{{$form->unread_count}}</td>
                </tr>
                </tbody>

            @endforeach
        </table>
    </x-main::box>
@endcanany
