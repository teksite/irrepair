@props(['url'=>null,'text','qrcode'=>null])
<div class="grid gap-4 md:grid-cols-2 items-center mb-12 border-y border-slate-200 w-1/3 mx-auto py-3">
    <h2 class="!mb-0 text-balance">
        {{__('share it')}}
    </h2>
    <div class="flex items-stretch justify-end gap-3 self-end">

        <div class="flex flex-col gap-3">
            <a href="https://t.me/share/url?url={{$url}}&text={{$text}}" target="_blank" title="{{__('share in :title' ,['title'=>__('telegram')])}}">
                <i class="tkicon fill-none stroke-blue-600" data-icon="telegram"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{$url}}&text={{$text}}" target="_blank" title="{{__('share in :title' ,['title'=>__('twitter')])}}">
                <i class="tkicon fill-none stroke-sky-600" data-icon="twitter"></i>
            </a>
            <a href="https://api.whatsapp.com/send?text={{$url}}" target="_blank" title="{{__('share in :title' ,['title'=>__('whatsapp')])}}">
                <i class="tkicon fill-none stroke-green-600" data-icon="whatsapp"></i>
            </a>
        </div>
        <div>
            <div title="scan me">
                {!! $qrcode !!}
            </div>
        </div>
    </div>
</div>

