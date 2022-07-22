<div class="add_product_form_{{ $i }}">
    <fieldset class="border border-solid border-gray-300 p-6 mb-8">
        <legend class="text-xxs pl-4 pr-4">Add Item </legend>

        <div class="mb-4">
            <x-inputs.text name="products[product_{{ $i }}][name]" label="{{ __('Item') }}"
                value="{{ old('name') }}" required autocomplete="name" autofocus />
        </div>

        <div class="mb-4">
            <x-inputs.text name="products[product_{{ $i }}][price]" label="{{ __('Price') }}"
                value="{{ old('price') }}" required autocomplete="price" autofocus />
        </div>

        <div class="mb-4">
            <x-inputs.text name="products[product_{{ $i }}][quantity]" label="{{ __('Quantity') }}"
                value="{{ old('quantity') }}" required autocomplete="quantity" autofocus />
        </div>

        <div class="mb-4">
            <x-inputs.text name="products[product_{{ $i }}][amount]" class="bg-gray-200"
                label="{{ __('Amount') }}" disabled value="{{ old('amount') }}" required autocomplete="amount"
                autofocus />
        </div>

        <div class="float-right delete-item">
            <button type="button" class="bg-red-500 p-2 -mt-48 rounded z-990 text-white text-xl delete-item" data-id="{{ $i }}"><i class="fa fa-trash"></i> Delete</button>
        </div>
    </fieldset>
</div>
