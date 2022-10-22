@csrf
<div class="mb-4">
    <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ old('name') }}" autocomplete="name" autofocus />
</div>

<div class="mb-4">
    <x-inputs.text name="code" label="{{ __('Code') }}" value="{{ old('code') }}" autocomplete="name" autofocus />
</div>

<div class="mb-4">
    <x-inputs.text name="probability" label="{{ __('Probability') }}" value="{{ old('probability') }}" required autocomplete="name" autofocus />
</div>

<div class="mb-4">
    <x-inputs.text name="sort_order" label="{{ __('Sort Order') }}" value="{{ old('sort_order') }}" required autocomplete="name" autofocus />
</div>