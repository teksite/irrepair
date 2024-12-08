@props(['model'])
<div>
    <h2>
        {{__('comments')}}
    </h2>
    @include('components.comment.comment-unconfirmed',['model'=>$model])
    <div>
        <div id="comment-sec">
            <hr class="my-12">
            @include('components.comment.comment-new',['model'=>$model])

            @if($model->comments() && $model->comments->count())
                <div id="comment-items" class="my-6">
                    <x-comment.comment-items :model="$model"/>
                </div>
                <x-modal name="reply-comment" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form action="{{route('comments.store')}}" method="POST" class="form form-comments p-3 tkform collect-data-form"
                          id="reply-comment-modal">
                        @csrf
                        <input type="hidden" name="formpot" value="">
                        <input type="hidden" id="commentable_type" name="commentable_type"
                               value="{{encrypt(get_class($model))}}">
                        <input type="hidden" id="commentable_id" name="commentable_id" value="{{$model->id}}">
                        <input type="hidden" id="parent_id" name="parent_id" value="0">
                        <h3 class="!mb-1">
                            {{__('reply')}}
                        </h3>
                        <p id="replyTo" class="!mb-1 text-sm"></p>
                        <div class="mt-6">
                            <x-input.label for="reply" value="reply" class="sr-only"/>
                            <x-input.textarea id="reply" name="message" class="block mx-auto w-full"
                                              placeholder="{{__('message')}}" required minlength="5"></x-input.textarea>
                            <x-input.error :messages="$errors->userDeletion->get('password')" class="mt-2"/>
                        </div>
                        @guest()
                            <div class="grid md:grid-cols-2 gap-6 my-3">
                                <div>
                                    <x-input.label :value="__('name')" class="" for="name-guest"/>
                                    <x-input.text id="name-guest" class=" block w-full" type="text" name="name" required :value="old('name')"/>
                                </div>
                                <div>
                                    <x-input.label :value="__('email')" class="" for="email-guest"/>
                                    <x-input.text id="email-guest" type="text" name="email" class="block w-full"  required :value="old('email')"/>
                                </div>
                                <div>
                                    <x-input.label :value="__('captcha code')" class="" for="captcha"/>
                                    <x-captcha::load/>
                                </div>
                            </div>
                        @endguest

                        <div class="mt-6 flex justify-between">
                            <button type="button" title="{{__('close')}}" x-on:click="$dispatch('close')" class="text-red-600 hover:text-red-800">
                                {{__('cancel')}}
                            </button>
                            <x-button.primary title="{{__('submit')}}" type="submit" class="me-3">
                                {{__('reply')}}
                            </x-button.primary>
                        </div>
                    </form>
                </x-modal>
            @endif
        </div>

        <div>
            <div class="hidden">
                <input type="hidden" class="hidden" readonly name="model" value="{{encrypt(get_class($model))}}" id="modelComment">
                <input type="hidden" class="hidden" readonly name="uid" value="{{$model->id}}" id="uidModelComment">
            </div>
            <x-button.primary type="button" role="button" id="moreComment" class="text-sm load-more">
                {{__('see the rest of comments')}}
            </x-button.primary>
        </div>

    </div>
</div>
