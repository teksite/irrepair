@if($errors->count())
    <ul class="my-6">
        @foreach ($errors->all() as $error)
            <li id="error-all-{{$loop->index}}"
                class="text-red-900 font-bold p-1 bg-red-500 border border-white border-dotted error-item transition-all duration-150 flex justify-between items-center">
                {{ $error }}
                <button type="button" role="button" class="deleteItemBtn" target="error-all-{{$loop->index}}">
                    &times;
                </button>
            </li>
        @endforeach
    </ul>
@endif

