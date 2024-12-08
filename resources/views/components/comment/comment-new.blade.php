@props(['model'])
<form class="tkform collect-data-form" action="{{route('comments.store')}}" method="POST" id="new-comment">
    @csrf
    <input type="hidden" name="commentable_id" value="{{$model->id}}">
    <input type="hidden" name="formpot" value="">
    <input type="hidden" name="commentable_type" value="{{encrypt(get_class($model))}}">
    <input type="hidden" name="parent_id" value="0">
    <div class="mb-1">
        <x-input.label :value="__('new :title',['title'=>__('comment')])" for="new-comment-message"/>
        <x-input.textarea name="message" required class="w-full block" rows="6" id="new-comment-message" placeholder="{{__('write your comment here')}}">{{old('message')}}</x-input.textarea>
        <x-input.error :messages="$errors->get('message')" class="mt-2"/>
    </div>
    @guest()
        <div class="grid md:grid-cols-3 gap-6 my-3">
            <div>
                <x-input.label :value="__('name')" class="" for="name"/>
                <x-input.text id="name" type="text" name="name" class="block w-full" required :value="old('name')"/>
            </div>
            <div>
                <x-input.label :value="__('email')" class="" for="email"/>
                <x-input.text id="email" type="text" name="email" class="block w-full" required :value="old('email')"/>
            </div>
            <div>
                <x-input.label :value="__('captcha code')" class="" for="captcha"/>
                <x-captcha::load/>
            </div>
        </div>
    @endguest
    <div class="flex items-center justify-end mt-3">
        <button title=" {{__('submit your comment')}}" type="submit"
                class="bg-green-900 hover:bg-green-600 text-white px-6 py-2 rounded-lg leading-none">
            {{__('send')}}
        </button>
    </div>

</form>

