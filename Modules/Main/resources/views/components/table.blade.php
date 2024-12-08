@props(['header'=>[] , 'linkable'=>true])
<div  class="overflow-x-auto">
<table {!! $attributes->merge(['class' => 'min-w-full overflow-x-scroll md:overflow-hidden divide-y divide-gray-200 rounded-lg ']) !!}>
    @if(count($header))
        <thead class="rounded-xl border border-slate-200">
        <tr>
            @foreach($header as $column=>$title)
                <th scope="col" class="px-6 py-3 text-xs font-medium uppercase text-start">
                    @if($linkable)
                        @php
                            if(request()->sort == 'asc'){$sort = 'desc';}else{$sort = 'asc';}
                                $currentParams = request()->query();
                                $additionalParams = ['order' =>$column,'sort'=>$sort];
                                $mergedParams = array_merge($currentParams, $additionalParams);
                                $queryString = http_build_query($mergedParams);
                        @endphp
                        @if(is_string($column))
                            <a href="{{ url()->current() }}?{{ $queryString }}"
                               class="{{request()->order == $column ? 'font-bold text-black' : ''}}">
                                @if(is_string($title))
                                    {{__($title)}}
                                @endif ⇅
                            </a>
                        @else
                            {{__($title)}}
                        @endif
                    @else
                        {{__($title)}}
                    @endif
                </th>
            @endforeach
        </tr>
        </thead>
    @endif
    <tbody class="divide-y divide-gray-200 border text-gray-900 ">
    {{$slot ?? ''}}
    </tbody>
    @isset($foot)
        <tfoot>
        {{ $foot  }}
        </tfoot>
    @endisset

</table>
</div>
