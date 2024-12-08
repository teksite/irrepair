@php use Illuminate\Database\Eloquent\Model; @endphp
@if( isset($instance) && $instance instanceof Model )
    <x-main::box>
        <div class="border border-slate-200 rounded-lg p-3 mb-1">
            @if($instance->created_at)
                <div class="flex justify-between items-center text-xs text-green-600 mb-1">
                    <span class="font-semibold">{{__('created at')}}</span>
                    <span>{{$instance->created_at}}</span>
                </div>
            @endif
            @if($instance->published_at)
                <div class="flex justify-between items-center text-xs text-yellow-600 mb-1">
                    <span class="font-semibold">{{__('published at')}}</span>
                    <span>{{$instance->published_at}}</span>
                </div>
            @endif
            @if($instance->updated_at)
                <div class="flex justify-between items-center text-xs text-blue-600 mb-1">
                    <span class="font-semibold">{{__('updated at')}}</span>
                    <span>{{$instance->updated_at}}</span>
                </div>
            @endif
            @if($instance->deleted_at)
                <div class="flex justify-between items-center text-xs text-red-600 mb-1">
                    <span class="font-semibold">{{__('deleted_at at')}}</span>
                    <span>{{$instance->deleted_at_at}}</span>
                </div>
            @endif
            <div class="flex justify-between items-center text-xs p">
                    <span class="font-semibold">{{__('publish status')}}</span>
                @if($instance->status)
                    <span>{{$instance->status ? __($instance->status->value) : __('published')}}</span>
                @else
                    <span>{{__('published')}}</span>

                @endif
            </div>
        </div>


    </x-main::box>
@endif


