@props(['data'])
@php
    use Spatie\SchemaOrg\Schema;
    use Spatie\SchemaOrg\Question;
    use Spatie\SchemaOrg\Answer;
    $items = collect($data)->map(function ($item) {
        return (new Question())
            ->name($item['title'] ?? $item['question'])
            ->acceptedAnswer(
                (new Answer())->text(strip_tags($item['body'] ?? $item['answer']))
            );
    });
    $faqScript = Schema::fAQPage()->mainEntity(array_values($items->toArray()))->toScript();
@endphp

@push('seo')
    {!! $faqScript !!}
@endpush

@php($random = rand(100, 999))
<div x-data="{ selected: null }" {{--itemscope itemtype="http://schema.org/FAQPage"--}}>
    @if ($data)
        <ul class="accordion-list space-y-3">
            @foreach ($data as  $dta)
                <li class="border border-secondary-700 p-3 rounded"{{-- itemscope itemprop="mainEntity" itemtype="http://schema.org/Question"--}}>
                    <div :class="selected === {{ $loop->index + 1 }} ? 'border-b' : ''">
                        <button type="button" role="button" title="{{__('question')}}:  {{ $dta['title'] ?? $dta['question'] }}"
                            class="w-full text-start flex items-center gap-6"
                            @click="selected = selected === {{ $loop->index + 1 }} ? null : {{ $loop->index + 1 }}"
                            :aria-expanded="selected === {{ $loop->index + 1 }}" :aria-seleced="selected === {{ $loop->index + 1 }}" aria-controls="aria-accordion-{{ $random }}-{{ $loop->index + 1 }}" >
                            <span class="font-semibold py-2 px-4 text-xl rounded-lg p-0 !mb-0">
                                {{ $loop->index + 1 }}
                            </span>
                            <span class="p px-1 py-2 text-sm"{{-- itemprop="name"--}}>
                                {{ $dta['title'] ?? $dta['question'] }}
                            </span>
                        </button>
                    </div>
                    <div class="overflow-hidden transition-all max-h-0 duration-700"
                     {{--     itemprop="acceptedAnswer"itemscope itemtype="http://schema.org/Answer" --}}id="aria-accordion-{{ $random }}-{{ $loop->index + 1 }}" x-ref="container{{ $loop->index + 1 }}"  x-bind:style="selected === {{ $loop->index + 1 }} ? 'max-height: ' + $refs.container{{ $loop->index + 1 }}.scrollHeight + 'px' : ''" >
                        <div class="p-3 p" {{--itemprop="text"--}}>
                            {!! $dta['body'] ?? $dta['answer'] !!}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
