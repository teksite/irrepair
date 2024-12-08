@props(['route','options'])
@php($random=rand(100,999))
<form method="POST" action="{{$route}}" id="selective-delete-{{$random}}">
    @csrf @method('DELETE')
 <div class="flex items-center justify-start p-3">
     <x-main::input.label class="me-3 !mb-0" for="delete-form-section-{{$random}}" :value="__('delete')"/>

     <select name="comments" id="delete-form-section-{{$random}}" class="border border-slate-200 px-3 py-1 rounded-s-lg w-fit min-w-48 focus:outline-2 focus:outline-blue-500">
         @foreach($options as $option)
             <option value="{{$option}}">
                 {{__($option)}}
             </option>
         @endforeach
     </select>
     <button type="submit" role="button" class="delete-item-btn inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-e-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" data-target="selective-delete-{{$random}}">
         {{__('apply')}}
     </button>
 </div>
    <x-main::input.error :messages="$errors->get('comments')" class="mt-2"/>
</form>
