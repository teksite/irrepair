<section class="mb-12" x-data="{'open':false}">
   @isset($intro)
        <div>
            {!! $intro !!}
        </div>
    @endisset
    <div x-show="open" x-transition x-bind:aria-expanded="open">
    {!! $slot !!}
    </div>
        <div class="text-center mt-6">
            <button x-on:click="open = ! open" x-text="open ? '{{__('close')}}' : '{{__('read more')}}'"
                    class=" bg-gray-200 px-3 py-1 rounded-lg transition-all duration-300 ease-linear shadow-none  hover:shadow-md hover:shadow-gray-400">
                {{__('read more')}}
            </button>
        </div>
</section>
