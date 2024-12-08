@if(isset($instance) && method_exists($instance,'path'))
    <div class="mb-3">
        <div class="md:flex gap-3 items-center">
            <div class="flex items-center gap-1">
                <x-main::input.label title="{{__('link')}}" for="gotToPage" class="!mb-0" value="<i class='tkicon regular fill-none stroke-current' stroke-width='2' data-icon='link' size='20'></i>"/>
            </div>
            <a id="gotToPage" href="{{$instance->path()}}" target="_blank" class="regular">
                {{$instance->path()}}
            </a>
        </div>
    </div>
@endif
