@props(['model','offset'=>0 ,'limit'=>5])

@foreach($model->comments()->latest()->where('parent_id',null)->whereConfirmed(true)->skip($offset)->take($limit)->get() as $comment)
    <div itemscope itemtype="https://schema.org/Comment" x-data="{selected:null}"
         class="border border-gray-200 rounded-lg p-3 mb-6 bg-slate-50 duration-75 ease-linear" >
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{$comment->user->featured_image ?? '/admin/images/no-profile.jpg'}}"
                     alt="{{$comment->user->name ?? $comment->name ??__('guest user')}}" decoding="async"
                     fetchpriority="low" loading="lazy" width="35" height="35">
                <span class="!mb-0 font-bold text-primary-900" itemprop="author" itemscope
                      itemtype="https://schema.org/Person">
                        <span itemprop="name">
                            {{$comment->user->name ?? $comment->name ??__('guest user')}}
                        </span>
                </span>
            </div>
            <div class="flex justify-end items-center gap-3">
                <button id="comment-reply-{{$comment->id}}" itemid="{{$comment->id}}" type="button"
                        title="{{__('reply')}}" x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'reply-comment')"
                        class="flex items-center gap-1 text-green-600 text-sm fill-green-600 hover:font-bold comment-reply-btn">
                    <i class="tkicon reply" size="12"></i>
                    {{__('reply')}}
                </button>
                <time class="text-xs p" itemprop="datePublished"
                      datetime="{{\Carbon\Carbon::parse($comment->created_at)->format('Y-m-d')}}">
                    {{ Carbon\Carbon::parse($comment->created_at)->lt(now()->subDays(14)) ? \Carbon\Carbon::parse($comment->created_at)->ago() : dateAdapter($comment->created_at , 'Y-m-d')}}
                </time>
            </div>
        </div>
        <div class="p break-all" id="comment-num-{{$comment->id}}"
             itemprop="commentText">
            {{$comment->message}}
        </div>
        @if($comment->children()->where('confirmed' ,true)->count())
            @php($random =rand(100,999).'-'.rand(100,900))
            <hr class="my-3">
            <div class="sub-comment">
                <div class="flex items-center justify-center">
                    <button type="button" title="{{__('reply')}}"  class="font-bold text-sm p" role="button"
                            :aria-expanded="selected == {{$loop->index}}" aria-controls="aria-accordion-{{ $random }}"
                            @click="selected !== {{$loop->index}} ? selected = {{$loop->index}} : selected = null">
                        {{__('show replies')}}
                    </button>
                </div>
                <div class="relative overflow-hidden transition-all max-h-0 px-3 py-1"
                     x-ref="container{{$loop->index}}" id="aria-accordion-{{ $random }}"
                     x-bind:style="selected == {{$loop->index}} ? 'max-height: ' + $refs.container{{$loop->index}}.scrollHeight + 'px' : ''">
                    <ul class="">
                        @foreach($comment->descendants()->where('confirmed' ,true)->depthFirst()->get() as $subComment)
                            <li class="border border-gray-300 rounded-lg p-3 my-3 hover:bg-white duration-75 ease-linear hover:shadow-lg">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <img src="{{$comment->user->featured_image ?? '/admin/images/no-profile.jpg'}}"
                                             alt="{{$comment->user->name ?? $comment->name ??__('guest user')}}"
                                             decoding="async" fetchpriority="low" loading="lazy" width="35" height="35">
                                        <span class="!mb-0 font-bold text-orange-900" itemprop="author" itemscope
                                              itemtype="https://schema.org/Person">
                                         <span itemprop="name">
                                             {{$comment->user->name ?? $comment->name ??__('guest user')}}
                                         </span>
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center gap-3">
                                        <button id="comment-reply-{{$subComment->id}}"
                                                itemid="{{$subComment->id}}" x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'reply-comment')"
                                                type="button" title="{{__('reply')}}"
                                                class="flex items-center gap-1 text-green-600 text-xs fill-green-600 hover:bg-green-300 comment-reply-btn">
                                            <i class="tkicon reply" size="9"></i>
                                            {{__('reply')}}
                                        </button>
                                        <time class="text-xs p"
                                              datetime="{{\Carbon\Carbon::parse($subComment->created_at)->format('Y-m-d')}}">
                                            {{ Carbon\Carbon::parse($comment->created_at)->lt(now()->subDays(14)) ? \Carbon\Carbon::parse($comment->created_at)->ago() : dateAdapter($comment->created_at , 'Y-m-d')}}
                                        </time>
                                    </div>
                                </div>
                                <div class="comment-message p break-all"
                                     id="comment-num-{{$subComment->id}}">
                                    {{$subComment->message}}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endforeach
