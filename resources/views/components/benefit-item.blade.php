@props(['benefit'])
<div class="w-full rounded-full relative bg-white flex gap-2 items-center shadow-lg">
    <div class="border h-full aspect-square border-white bg-gray-200/75 rounded-full p-3 shadow-inner shadow-zinc-400 flex items-center justify-center">
        <span class="p-2 aspect-square w-full bg-primary-950 rounded-full flex items-center justify-center">
            <i class="tkicon fill-none stroke-gray-200" size="18" data-icon="tick" stroke-width="3"></i>
        </span>
    </div>
    <span class="self-center w-full shadow-inner py-3 px-3 rounded-full">
       {{$benefit['title']}}
    </span>
</div>
