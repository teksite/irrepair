@props(['model'])
@auth()
    @if(auth()->user()->comments()->where('model_type' , get_class($model))->whereConfirmed(false)->count())
        <div class="opacity-50 p-3">
            <h4>{{__('your pending comments')}} ...</h4>
            <ul class="space-y-3">
                @foreach(auth()->user()->comments()->where('model_type' , get_class($model))->whereConfirmed(false)->limit(5)->get() as $comment)
                    <li class="break-all text-sm text-gray-400 p-1 border border-slate-300 border-dotted">
                        {{$comment->message}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endauth
