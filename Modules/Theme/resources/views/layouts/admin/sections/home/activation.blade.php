@props(['open'=>true])
@php
$activationRow=  $instance?->meta()->where('key', 'activation')->first();
if($activationRow){
    $selection=($activationRow->value)[0];
}else{
    $selection='no';
}
@endphp
<x-main::accordion-editor :title="__('activation')" :open="$open">
    <section>
        <main::x-box>
            <x-main::input.select value="" name="extra[activation]">
                <option value="no" {{$selection=='no' ? 'selected' : ''}}>{{__('no')}}</option>
                <option value="yes" {{$selection=='yes' ? 'selected' : ''}}>{{__('yes')}}</option>
            </x-main::input.select>
        </main::x-box>
    </section>
</x-main::accordion-editor>
