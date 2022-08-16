@props(
    [
        'name',
        'label',
        'value',
    ]
)
<x-Quotation.inputs.basic type="text" :label="$label ?? '' " :name="$name"  :value="$value ?? ''" :attributes="$attributes" ></x-Quotation.input.text>

