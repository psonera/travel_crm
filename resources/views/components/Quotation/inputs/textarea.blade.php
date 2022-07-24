@props(
    [
        'name',
        'label',
    ]
)

@if($label ?? null)
    @include('components.Quotation.inputs.partials.label',['required'=>false])
@endif
<textarea
    id="{{ $name }}"
    name="{{ $name }}"
    rows="6"
    {{ $attributes->merge(['class' => 'block appearance-none w-full py-1 px-2 text-base leading-normal text-gray-800 border border-gray-200 rounded']) }}
>{{$slot}}</textarea>
