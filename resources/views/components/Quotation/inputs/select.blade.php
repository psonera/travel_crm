@props([
    'name',
    'label',
    'type'=>'text'
])
@if($label ?? null)
@include('components.Quotation.inputs.partials.label')
@endif
<select size="1"
    id="{{$name}}"
    name="{{$name}}"
    :label="$label"
    {{ ($required ?? false) ? 'required' : '' }}
    {{ $attributes->merge(['class' => 'block appearance-none w-full py-1 px-2 text-base leading-normal text-gray-800 border border-gray-200 rounded']) }}
    autocomplete="off"
>{{ $slot }}</select>
@error($name)
    @include('components.inputs.partials.error')
@enderror
