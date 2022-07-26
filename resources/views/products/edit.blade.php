<x-app-layout>
    @section('title', 'Edit Product')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Edit Product</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('products.update',$product) }}">
                        @method('put')
                        @csrf   
                        <div class="mb-4">
                            <x-inputs.text name="sku" label="{{ __('Sku') }}" value="{{ $product->sku }}"  autocomplete="sku" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ $product->name }}"  />
                        </div>

                        <div class="mb-4">
                            <x-inputs.textarea name="description" label="{{ __('Description') }}" autocomplete="description" autofocus >{!! $product->description !!}</x-inputs.textarea>
                        </div>

                        <div class="mb-4">
                            <x-inputs.text name="quantity" label="{{ __('Quantity') }}" value="{{ $product->quantity }}"  autocomplete="quantity" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.text name="price" currencySymbol="true" label="{{ __('Price') }}" value="{{ $product->price }}"  autocomplete="price" autofocus />
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                Edit Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
