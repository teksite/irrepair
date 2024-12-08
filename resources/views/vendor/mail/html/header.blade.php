@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{url()}}/uploads/logos/logo.png" class="logo" alt="{{__(config('app.name'))}}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
