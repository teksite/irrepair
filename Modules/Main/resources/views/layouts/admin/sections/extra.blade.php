@props(['config'])
@foreach($config as $key=>$conf)
    @if($key == $instance->template)
        @foreach($conf as $cnf)
            @php($template=$cnf['template'])
            @include("theme::layouts.admin.sections.extra.$template",['open'=>$cnf['open'] ?? "false",...$cnf,'instance'=>$instance])
        @endforeach
    @endif
    <x-main::input.error :messages="$errors->get('extra')" class="my-2"/>
    <x-main::input.error :messages="$errors->get('extra.*')" class="my-2"/>

@endforeach
