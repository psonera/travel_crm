@props([
    'id',
    'name',
    'label',
    'value',
    'checked' => false,
])

@php
    $checked = !! $checked
@endphp

<div class="relative block mb-2">

    <input
        type="radio"
        id="{{ $id ?? $name }}"
        name="{{ $name }}"
        value="{{ $value ?? 1 }}"
        {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => 'text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow']) }}
    >

    @if($label ?? null)
        <label class="text-gray-700 pl-2" for="{{ $id ?? $name }}">
            {{ $label }}
        </label>
    @endif
</div>

@error($name)
    @include('components.inputs.partials.error')
@enderror