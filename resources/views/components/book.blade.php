@php use Modules\Catalog\Models\Catalog; @endphp
@props(['catalogue'])
@php($catalogue =$catalogue instanceof Catalog ? $catalogue : Catalog::find($catalogue) )
@if($catalogue)
    <div class="book-box max-w-fit">
        <div class="book-container">
            <div class="book">
                <img loading="lazy" width="200" height="300" alt="{{$catalogue->title}}" fetchpriority="low" decoding="async" src="{{$catalogue->featured_image}}">
            </div>
        </div>
        <div class="mt-16 text-center">
            <a target="_blank" class="px-4 py-2 font-semibold text-sm rounded-md shadow-sm ring-2 ring-offset-2 ring-blue-500/50 ring-offset-slate-900 bg-slate-700 text-slate-200 border-transparent inline-flex gap-1 justify-center items-center fill-none stroke-gray-200"
               href="{{$catalogue->file}}"  title="{{__('download')}}">
                <i class="tkicon fill-none stroke-gray-200" data-icon="download"></i>{{$catalogue->title}}
            </a>
        </div>
    </div>

@endif
