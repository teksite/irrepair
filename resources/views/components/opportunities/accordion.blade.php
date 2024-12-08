@php($random='sdf'.rand(10000,99999))

<div class="w-full lg:hidden" >
    <div class="accordion-list" role="tablist" x-data="{selected:null}">
        @foreach($instance as $opportunity)
            <div class="p-3 rounded">
                <button type="button" role="tab" title="{{__('open').'/'.__('close')}}"
                                class="w-full text-start flex items-center justify-between gap-6 border-b-2"
                                :class="selected === {{$loop->index}} ?  'text-orange-700  border-orange-700' :' border-gray-400 {{$opportunity->status->value === 'published' ? 'text-gray-700': 'text-gray-300'}}'"
                                @click="selected !== {{$loop->index}} ? selected = {{$loop->index}} : selected = null"
                                x-bind:aria-expanded="selected =={{$loop->index}} ?? false"
                                aria-controls="aria-accordion-{{$random}}-{{$loop->index}}">
                            {{$opportunity->title}}
                            <span x-text="selected !=  {{$loop->index}}? '+' : '-'">+</span>
                        </button>
                <div class="overflow-hidden transition-all max-h-0 duration-700" id="aria-accordion-{{$random}}-{{$loop->index}}" x-ref="container{{$loop->index}}"
                     x-bind:style="selected == {{$loop->index}} ? 'max-height: ' + $refs.container{{$loop->index}}.scrollHeight + 'px' : ''">
                     <div class="p-3 p">
                     @if($opportunity->status->value !== 'published')
                     <span class="text-red-600 font-bold">
                        {{__('this opportunity is not active')}}
                     </span>
                     @endif
                     @if($opportunity->body)
                         <p>
                             {!! $opportunity->body !!}
                         </p>
                         <hr class="my-3">
                     @endif
                     @if($opportunity->requirements->count())
                         <h4 class="!mb-2">
                             {{__('requirements')}}
                         </h4>
                         <ul class="list-disc list-inside">
                             @foreach($opportunity->requirements as $requirement)
                                 <li class="p">
                                     {{$requirement}}
                                 </li>
                             @endforeach
                         </ul>

                     @endif
                     @if($opportunity->advantages->count())
                         <hr class="my-6">
                         <h4 class="!mb-2">
                             {{__('advantages')}}
                         </h4>
                         <ul class="list-disc list-inside">
                             @foreach($opportunity->advantages as $advantage)
                                 <li class="p">
                                     {{$advantage}}
                                 </li>
                             @endforeach
                         </ul>

                     @endif
                     @if($opportunity->status->value !== 'published')
                        <span class="text-red-600 font-bold">
                            {{__('this opportunity is not active')}}
                        </span>

                     @endif
                     </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
