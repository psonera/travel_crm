@props([
    'name',
    'label',
    'value',
    'currencySymbol'
])

<x-inputs.basic type="text" :name="$name" label="{{ $label ?? ''}}" currencySymbol="{{ $currencySymbol ?? '' }}" :value="$value ?? ''" :attributes="$attributes"></x-inputs.basic>