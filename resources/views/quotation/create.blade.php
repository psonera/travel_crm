<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-xl font-bold">Create Quotation</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{route('quotation.store')}}">
                        @csrf
                        <fieldset class="border border-solid border-gray-300 p-6">
                            <legend class="text-xl pl-4 pr-4">Quotation Information</legend>
                            <div class="mb-4">
                                <x-Quotation.inputs.select name="owner" label="{{ __('Sales owner') }}" value="{{}}" required>
                                    <option selected value="">Owner 1</option>
                                    <option value="">Owner 2</option>
                                    <option value="">Owner 3</option>
                                    <option value="">Owner 4</option>
                                </x-inputs.select>
                            </div>
                            @error('owner')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <div class="mb-4">
                                <x-Quotation.inputs.text name="subject" label="{{__('Subject')}}" value="{{old('')}}" required autofocus/>
                            </div>
                            @error('lead_body')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-Quotation.inputs.textarea name="description" label="{{__('Description')}}"  autofocus/>
                            </div>
                            @error('lead_value')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror


                            <div class="mb-4">
                                <x-Quotation.inputs.text name="person" label="{{__('Person')}}" value="{{old('')}}" required autofocus/>
                            </div>
                            @error('lead_type_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-Quotation.inputs.text name="Lead" label="{{__('Lead')}}" value="{{old('')}}" required autofocus/>
                            </div>
                            @error('lead_manager_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                               <div class="container border border-black ">
                                <h2 style="font-weight: 600; margin-bottom:10px;  margin-top:10px;">Shipping Address</h2>
                               <div class="columns-2">
                                <div >
                                    <x-Quotation.inputs.textarea   name="billing_address"  autofocus/>
                                </div>
                                <div>

                                   <div>
                                    <x-Quotation.inputs.select name="contry"  required  class="m-2">
                                        <option value=1>india</option>
                                     </x-Quotation.inputs.select>
                                     <x-Quotation.inputs.select name="state"  required class="m-2">
                                        <option value=1>Gujarat</option>
                                     </x-Quotation.inputs.select>
                                     <x-Quotation.inputs.select name="city"  required class="m-2">
                                        <option value=1>dakor</option>
                                     </x-Quotation.inputs.select>
                                     <x-Quotation.inputs.select name="postcode"  required class="m-2">
                                        <option value=1>388225</option>
                                     </x-Quotation.inputs.select>
                                   </div>
                                </div>
                               </div>
                               </div>
                            </div>
                            <div class="mb-4">
                                <div class="container border border-black ">
                                    <h2 style="font-weight: 600; margin-bottom:10px;  margin-top:10px;">Shipping Address</h2>
                                <div class="columns-2">
                                 <div >
                                     <x-Quotation.inputs.textarea   name="shipping_address"  autofocus/>
                                 </div>
                                 <div>

                                    <div>
                                     <x-Quotation.inputs.select name="contry"  required  class="m-2">
                                        <option value=1>india</option>
                                     </x-Quotation.inputs.select>
                                     <x-Quotation.inputs.select name="state"  required class="m-2">
                                        <option value=1>Gujarat</option>
                                     </x-inputs.select>
                                     <x-Quotation.inputs.select name="city"  required class="m-2">
                                        <option value=1>dakor</option>
                                     </x-Quotation.inputs.select>
                                     <x-Quotation.inputs.select name="postcode"  required class="m-2">
                                        <option value=1>388225</option>
                                     </x-Quotation.inputs.select>
                                    </div>

                                 </div>
                                </div>
                                </div>
                             </div>

                             <div class="mb-4 conatiner border border-black ">
                                <span class="font-bold">Quotation Item</span>
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
                                            <tr>
                                                <td><x-Quotation.inputs.text name="name" label="" value="{{old('')}}" required autofocus/></td>
                                                <td><x-Quotation.inputs.number name="quontity" label="" value="{{old('')}}" required autofocus/></td>
                                                <td><x-Quotation.inputs.number name="price" label="" value="{{old('')}}" required autofocus/></td>
                                                <td><x-Quotation.inputs.number name="Amount" label="" value="{{old('')}}" required autofocus/></td>
                                                <td><x-Quotation.inputs.number name="discount" label="" value="{{old('')}}" required autofocus/></td>
                                                <td><x-Quotation.inputs.number name="tax" label="" value="{{old('')}}" required autofocus/></td>
                                                <td><x-Quotation.inputs.number name="total" label="" value="{{old('')}}" required autofocus/></td>
                                            </tr>
                                           <tr>
                                        </tbody>
                                    </table>
                                    <button class="button mt-1">ADD</button>

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

                            </fieldset>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-black uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Save As Quotation
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
