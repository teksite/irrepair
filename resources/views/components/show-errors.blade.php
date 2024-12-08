@if(isset($errors) && $errors->count())
    <ul class="fixed start-3 top-3 w-fit z-[201] space-y-1" id="errorList">
        @foreach ($errors->all() as $error)
        <li id="error-all-{{$loop->index}}" class="errorList-item error-item bg-primary-950/90 text-gray-200 rounded text-sm flex gap-1 items-center stroke-2 p-3 ">
         <i class="tkicon fill-none stroke-red-600" data-icon="exclamation-circle"></i>
         <span>
             {{ $error }}
         </span>
        @endforeach
    </ul>
@endif
