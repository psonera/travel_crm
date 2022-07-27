<div>
    <div class="m-2">
        <table class="table-auto">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quntity</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach($items as $item)
                <tr wire:key="index.{{$item['key']}}">
                    <td >
                        <input wire:model="item.{{$item['key']}}"  type="text" class ='text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow' >

                          <div>
                            @forelse ($products as $product )
                             <li  wire:click="select('{{$product->name}}')" > {{$product->name}}</li>
                            @empty
                                null
                            @endforelse
                        </div>

                    </td>
                    <td><input wire:model="quntity" type="text" class ='text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow'></td>
                    <td><input wire:model="price" type="text" class ='text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow'></td>
                    <td><input wire:model="amount" type="text" class ='text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow'></td>
                    <td><input wire:model="discount" type="text" class ='text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow'></td>
                    <td><input wire:model="tax" type="text" class ='text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow'></td>
                    <td><input wire:model="total" type="text" class ='text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow'></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="button mt-1" wire:click.prevent = "additem">ADD</button>
        <div class="flex flex-row-reverse">
            <div class="cotainer w-34">
                <div class="columns-2 mt-3">
                     sub Total -
                    <x-Quotation.inputs.number name="subtotal" label="" value="{{old('')}}" required/>
                </div>
                <div class="columns-2 mt-3">
                    <div> Discount -</div>
                    <div><x-Quotation.inputs.number name="discount" label="" value="{{old('')}}" required/></div>
                </div>
                <div class="columns-2 mt-3">
                    <div>Tax-</div>
                    <div> <x-Quotation.inputs.number name="tax" label="" value="{{old('')}}" required/></div>
                </div>
                <div class="columns-2 mt-3">
                    <div>Adjustment -</div>
                    <div> <x-Quotation.inputs.number name="adjustment" label="" value="{{old('')}}" required/></div>
                </div>
                <div class="columns-2 mt-3">
                    <div>GrandTotal -</div>
                    <div>   <x-Quotation.inputs.number name="grandtotal" label="" value="{{old('')}}" required/></div>
                </div>
            </div>
        </div>
    </div>
</div>
