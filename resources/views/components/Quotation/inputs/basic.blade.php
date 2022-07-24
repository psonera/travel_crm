@props([
    'name',
    'label',
    'value',
    'type' => 'text',
    'min' => null,
    'max' => null,
    'step' => null,
    'placeholder'=>'',
])

@if($label ?? null)
    @include('components.Quotation.inputs.partials.label')
@endif

<input
    type="{{ $type }}"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ old($name, $value ?? '') }}"
    {{ ($required ?? false) ? 'required' : '' }}
    {{ $attributes->merge(['class' => 'text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow']) }}
    {{ $min ? "min={$min}" : '' }}
    {{ $max ? "max={$max}" : '' }}
    {{ $step ? "step={$step}" : '' }}
    autocomplete="off"
    :placeholder="{{$placeholder}}"
>

@error($name)
    @include('components.inputs.partials.error')
@enderror
