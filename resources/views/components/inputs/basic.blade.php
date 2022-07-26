@props([
    'name',
    'label',
    'value',
    'type' => 'text',
    'min' => null,
    'max' => null,
    'step' => null,
])

@if($label ?? null)
    @include('components.inputs.partials.label')
@endif

@if($attributes->get('required') ?? false)
    <span class="text-red-500">*</span>
@endif

@if($attributes->get('currencySymbol') ?? false)
    <div class="flex">
    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-lg border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
        <i class="fas fa-rupee-sign"></i>
    </span>
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
>

@if($attributes->get('currencySymbol') ?? false)
    </div>
@endif    
@error($name)
    @include('components.inputs.partials.error')
@enderror