<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('img/logo.svg') }}" class="inline h-full max-w-full transition-all duration-200 ease-nav-brand" alt="main_logo" />
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
