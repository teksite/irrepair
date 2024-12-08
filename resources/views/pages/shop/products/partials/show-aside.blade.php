<section class="p-2">
    <h2 class="text-blue-400 px-3 py-2 !mb-0">
        {{__('chapters')}}
    </h2>
    <hr class="my-3">
    <ul class="overflow-y-auto h-[475px] space-y-3">

        @foreach($course->chapters()->orderBy('order')->get() as $chapter)
            <li>
                <span class="ps-3 text-gray-400 mb-3 block">
                    {{$chapter->title}}
                </span>
                <ul class="ps-3 space-y-6">
                    @foreach($chapter->episodes()->orderBy('order')->get() as $eps)
                        <li>
                            <div class="flex items-center gap-3">
                                @if(!auth()->check() || ($course->type !='public' && !auth()->user()->hasCourse($course)))
                                    <i class="tkicon stroke-red-500 fill-none" size="16" data-icon="lock-closed"></i>
                                @else
                                    <i class="tkicon {{$eps->path() == $episode->path() ?'fill-secondary-600 stroke-secondary-600' :'fill-none stroke-secondary-600'}}"
                                       size="8" data-icon="circle"></i>
                                @endif
                                <a href="{{route('courses.episodes.show' , [$course, $eps])}}"
                                   class=" text-sm {{$eps->path() == $episode->path() ?'text-secondary-600 font-bold' :'text-gray-200'}}">
                                    {{$eps->title}}
                                </a>
                                @if($eps->userView() && $eps->duration &&  $eps->duration != 0)
                                    @php
                                        $percentView=0;
                                        $percentView = ($eps->userView()->time / $eps->duration) * 100;
                                        $percentView = $percentView >= 100 ? '100' : (integer)floor($percentView);
                                    @endphp
                                    <span class="text-blue-300 text-xs font-bold">
                                        ( {{$eps->userView()?->stance ? __($eps->userView()?->stance) : ''}} {{$percentView ?? ''}}% )
                                    </span>
                                @endif
                            </div>

                        </li>
                    @endforeach
                </ul>
            </li>

        @endforeach
    </ul>
</section>
