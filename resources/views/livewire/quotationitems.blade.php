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
