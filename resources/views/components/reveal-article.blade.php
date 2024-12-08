@props(['instance'])
<article class="mb-12" x-data="{'open':false}">
    <h2>
        {{$instance->article->title}}
    </h2>
    <hr class="w-1/4 my-3">
    <div>
        <p>
            {!! $instance->article->excerpt !!}
        </p>
    </div>
    <div x-show="open" x-transition x-bind:aria-expanded="open">
        {!! $instance->article->body !!}
    </div>
    <div>
        <div class="text-center mt-6">
            <button x-on:click="open = ! open" x-text="open ? '{{__('close this')}}' : '{{__('read more')}}'"
                    class=" bg-gray-200 px-3 py-1 rounded-lg transition-all duration-300 ease-linear shadow-none  hover:shadow-md hover:shadow-gray-400">
                {{__('read more')}}
            </button>
        </div>
    </div>
</article>
