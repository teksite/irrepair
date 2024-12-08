@php($random='sd'.rand(10000,99999))

<div class="hidden lg:block  w-full">
    <div class="container flex justify-center w-full" x-data="{tab: 0}">
        <div class="flex flex-col justify-start w-full" id="opportunities-list" role="tablist">
           @foreach($instance as $opportunity)
                    <button @click.prevent="tab ={{$loop->index}}"
                        type="button" role="tab" aria-selected="true" aria-controls="aria-tab-{{$random}}-{{$loop->index}}" id="tab-{{$loop->index}}" x-bind:aria-selected="tab =={{$loop->index}} ?? false"
                            class="{{$opportunity->status->value =='published' ? 'text-primary-950' :'text-gray-300'}} job-opportunity-item px-3 py-6 text-lg overflow-hidden rounded-s-lg flex items-center gap-3 border border-slate-200 transform"
                            :class="{'z-20  font-bold bg-primary-900 !text-gray-200': tab === {{$loop->index}}}">
                    <span class="p-0.5 aspect-square bg-primary-900 rounded-full flex items-center justify-center">
                        <span class="w-6 p-1 aspect-square bg-gray-50 rounded-full flex items-center justify-center text-xs text-primary-900">
                            {{$loop->iteration}}
                        </span>
                    </span>
                        <span class="opportunity-title">
                        {{$opportunity->title}}
                    </span>
                    </button>
                @endforeach
        </div>
        <div class="w-full border border-slate-200 rounded-e-lg" id="opportunities-box">
        @foreach($instance as $opportunity)
              <div class="space-y-6 h-full flex flex-col gap-1" x-show="tab === {{$loop->index}}" id="aria-tab-{{$random}}-{{$loop->index}}">
                  <div x-show="tab === {{$loop->index}}" role="definition" aria-expanded="false" :aria-expanded="tab === {{$loop->index}}" x-transition:enter="transition duration-500 transform ease-in"  x-transition:enter-start="opacity-0">
                     <div class="p-3 md:p-6 h-full">
                                <div class="flex flex-col justify-between h-full overflow-y-auto opportunities-description">
                                   <div class="flex gap-3 items-center justify-start">
                                            <i class="tkicon fill-none stroke-orange-600" size="32" data-icon="briefcase"></i>
                                            <h3 class="!mb-0">
                                                {{$opportunity->title}}
                                            </h3>
                                        </div>
                                   @if($opportunity->status->value !=='published')
                                            <span class="text-red-600 font-bold">
                                                {{__('this opportunity is not active')}}
                                            </span>
                                        @endif
                                   @if($opportunity->body)
                                            <hr class="my-3">
                                            <p>
                                                {!! $opportunity->body !!}
                                            </p>
                                        @endif
                                   @if($opportunity->requirements->count())
                                            <hr class="my-3">
                                            <h4 class="!mb-2">
                                                {{__('these skills are required')}}
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
                                                {{__('these skills are consider as advantages')}}
                                            </h4>
                                            <ul class="list-disc list-inside">
                                                @foreach($opportunity->advantages as $advantage)
                                                    <li class="p">
                                                        {{$advantage}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                </div>
                            </div>
                   </div>
                  @if($opportunity->status->value !=='published')
                      <span class="text-red-600 font-bold p-0.5 block min-h-fit">
                            {{__('this opportunity is not active')}}
                      </span>
                  @endif
              </div>
        @endforeach
        </div>
    </div>
</div>



