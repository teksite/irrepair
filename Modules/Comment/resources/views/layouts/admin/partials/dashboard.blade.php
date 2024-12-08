@can('form-receive-read')
    <x-main::box>
        <h3 class="text-center mb-3">
            {{__('comments')}}
        </h3>
        <table class="w-full text-center">
            <thead>
            <tr>
                <th>{{__('title')}}</th>
                <th>{{__('all')}}</th>
                <th>{{__('unconfirmed')}}</th>
            </tr>
            </thead>
            <tbody>
            @php($comments=\Modules\Comment\Models\Comment::selectRaw('COUNT(*) as total_comments, SUM(CASE WHEN confirmed = 0 THEN 1 ELSE 0 END) as unconfirmed_comments')->first())

            <tr>
                <td class="font-bold p-2">
                    <a class="regular" href="{{route('admin.comments.index')}}">{{__('comments')}}</a>
                </td>
                <td>
                        <span>
                            {{$comments->total_comments ?? 0}}
                        </span>
                </td>
                <td>
                        <span class="font-bold text-orange-600">
                            {{$comments->unconfirmed_comments ?? 0}}
                        </span>
                </td>

            </tr>
            </tbody>
        </table>
    </x-main::box>
@endcanany
