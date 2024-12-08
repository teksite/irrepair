<div class="flex items-center gap-3">
    <form action="" method="get">
        <div class="flex items-stretch shadow-sm w-ful border border-slate-200 rounded-lg focus-within:outline-2 focus-within:outline-blue-500 overflow-hidden">
            <input name="s" class="bg-transparent focus:outline-0 w-full block p-1" value="{{request()->s ?? ''}}" aria-label="{{__('search')}}">
            <div class="flex items-center min-h-fit w-fit border-s border-slate-200 p-1">
                <button type="submit" title="{{__('search')}}" class="flex items-center p-1">
                    <i class="tkicon fill-none stroke-slate-600" size="20" data-icon="magnifier"></i>
                </button>
                @if(request()->s)
                    <a href="{{request()->fullUrlWithoutQuery(['s'])}}" class="text-xs border-s border-slate-200 text-slate-600 p-1 leading-none flex items-center justify-center">
                        {{__('all')}}
                    </a>
                @endif
            </div>
        </div>
    </form>

</div>
