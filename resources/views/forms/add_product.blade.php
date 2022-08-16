<div class="add_product_form_{{ $i }}">
    <fieldset class="border border-solid border-gray-300 p-6 mb-8">
        <legend class="text-xxs pl-4 pr-4">Add Item </legend>

        <div class="mb-4 relative">
            <x-inputs.text name="products[{{ $i }}][name]" class="find_product"
                data-id="{{ $i }}" label="{{ __('Item') }}" required
                placeholder="Start typing title..." autocomplete="name" autofocus />
            <ul class="select_prd bg-white absolute shadow border-gray-100 appearance-none block border border-gray-200 leading-normal px-2 py-1 rounded text-base text-gray-800 w-full hidden z-990"
                id="select_prd_{{ $i }}">
            </ul>
        </div>

        <div class="mb-4">
            <x-inputs.text name="products[{{ $i }}][price]" label="{{ __('Price') }}" class="edit_price" data-id="{{ $i }}"
             required autocomplete="price" autofocus />
        </div>

        <div class="mb-4">
            <x-inputs.text name="products[{{ $i }}][quantity]" label="{{ __('Quantity') }}" class="edit_qty" data-id="{{ $i }}"
             required autocomplete="quantity" autofocus />
        </div>

        <div class="mb-4">
            <x-inputs.text name="products[{{ $i }}][amount]" class="bg-gray-200"
                label="{{ __('Amount') }}" disabled required autocomplete="amount"
                autofocus />
        </div>
        <x-inputs.hidden name="products[{{ $i }}][id]" class="product_id" />

        <div class="float-right delete-item">
            <button type="button" class="bg-red-500 p-2 -mt-48 rounded z-990 text-white text-xl delete-item"
                data-id="{{ $i }}"><i class="fa fa-trash"></i> Delete</button>
        </div>
    </fieldset>
</div>
