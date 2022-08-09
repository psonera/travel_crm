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
                                <livewire:selectmanager  />
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
                                <livewire:serachleadmanager />
                            </div>
                            @error('lead_type_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <livewire:serachlead  />
                            </div>
                            @error('lead_manager_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                               <div class="container border border-black ">
<<<<<<< Updated upstream
                                <h2 style="font-weight: 600; margin-bottom:10px;  margin-top:10px;">Shipping Address</h2>
=======
                                <h2 style="font-weight: 600; margin-bottom:10px;  margin-top:10px;">Billing Address</h2>
>>>>>>> Stashed changes
                               <div class="columns-2">
                                <div >
                                    <x-Quotation.inputs.textarea   name="billing_address"  autofocus/>
                                </div>
                                <div>

                                   <div>
<<<<<<< Updated upstream
                                    <x-Quotation.inputs.select name="contry"  required  class="m-2">
                                        <option value=1>india</option>
                                     </x-Quotation.inputs.select>

                                       <livewire:addstate />

                                     <x-Quotation.inputs.select name="city"  required class="m-2">
                                        <option value=1>dakor</option>
                                     </x-Quotation.inputs.select>
                                     <x-Quotation.inputs.select name="postcode"  required class="m-2">
=======
                                    <x-Quotation.inputs.select name="b_contry"  required  class="m-2">
                                        <option value=1>india</option>
                                     </x-Quotation.inputs.select>
                                       <livewire:addstate />
                                     <x-Quotation.inputs.select name="b_city"  required class="m-2">
                                        <option value=1>dakor</option>
                                     </x-Quotation.inputs.select>
                                     <x-Quotation.inputs.select name="b_postcode"  required class="m-2">
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                                     <x-Quotation.inputs.select name="contry"  required  class="m-2">
                                        <option value=1>india</option>
                                     </x-Quotation.inputs.select>
                                     <livewire:addstate />
                                     <x-Quotation.inputs.select name="city"  required class="m-2">
                                        <option value=1>dakor</option>
                                     </x-Quotation.inputs.select>
                                     <x-Quotation.inputs.select name="postcode"  required class="m-2">
=======
                                     <x-Quotation.inputs.select name="s_contry"  required  class="m-2">
                                        <option value=1>india</option>
                                     </x-Quotation.inputs.select>
                                     <livewire:s-addstate  />
                                     <x-Quotation.inputs.select name="s_city"  required class="m-2">
                                        <option value=1>dakor</option>
                                     </x-Quotation.inputs.select>
                                     <x-Quotation.inputs.select name="s_postcode"  required class="m-2">
>>>>>>> Stashed changes
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
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <tr class="itemrow"><td class="itemsid" hidden><input hidden type="text"  name="itemid[]"></td><td><input name="itemname[]" type="text" class=" itemname text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"></td><td class="itemquntity"><input type="text" name="itemquntity[]" class="  text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"></td><td class="itemprice"><input name="itemprice[]" type="text" class="  text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"></td><td class="itemtotal"><input  name='total[]' type="text" class="  text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"></td></tr>

                                        </tbody>
                                    </table>
                                    <span class="button" id="addmore">ADD</span>

                                    <div class="flex flex-row-reverse">
                                        <div class="cotainer w-34">
                                            <div class="columns-2 mt-3">
                                                 sub Total -
                                                <x-Quotation.inputs.text id="subtotal" name="subtotal" label="" value="{{old('')}}" required/>
                                            </div>
                                            <div class="columns-2 mt-3">
                                                <div> Discount -</div>
                                                <div><x-Quotation.inputs.text   id="discount" name="discount" label="" value="{{old('')}}" required/></div>
                                            </div>
                                            <div class="columns-2 mt-3">
                                                <div>Tax-</div>
                                                <div> <x-Quotation.inputs.text id="tax" name="tax" label="" value="{{old('')}}" required/></div>
                                            </div>

                                            <div class="columns-2 mt-3">
                                                <div>GrandTotal -</div>
                                                <div>   <x-Quotation.inputs.text   id="grandtotal" name="grandtotal" label="" value="{{old('')}}" required/></div>
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

    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script>
        $(document).ready(function(){


                function final(d=0,t=0){
                    console.log('in final');
                    var alltotal = document.getElementsByName('total[]')
                    var subtotal = 0;
                    var discount = d;
                    var tax = t;
                    console.log(d+"---------"+t);
                    var grandtotal = Number(0);
                    $("#discount").val(discount);
                    $("#tax").val(tax);
                    $("#grandtotal").val(Number(grandtotal));
                    if(alltotal!="NaN"){
                        for(var i=0;i<alltotal.length;i++){
                            subtotal = Number(subtotal) + Number(alltotal[i].value);
                        }
                    }
                    subtotal = parseFloat(subtotal);
                    $("#subtotal").val(subtotal);
                    discount = $("#discount").val();
                    tax = $("#tax").val();




                    if(discount!=0){

                        var dam = parseFloat(discount);
                        console.log(dam);
                        subtotal = Number(subtotal) - (parseFloat(discount/100)*Number(subtotal))
                        console.log(subtotal);
                        $("#grandtotal").val(Number(subtotal));
                        subtotal = parseFloat(subtotal);
                    }

                    if(tax!=0){
                        subtotal = Number(subtotal) + (parseFloat(subtotal)*parseFloat(tax/100))
                        $("#grandtotal").val(Number(subtotal));
                    }
                    $("#grandtotal").val(Number(subtotal.toFixed(2)));
                }
                final();

                $('#addmore').click(function(event){
                    event.preventDefault();
                    $('tbody').append('<tr class="itemrow"><td class="itemsid" hidden><input hidden type="text"  name="itemid[]"></td><td><input name="itemname[]" type="text" class=" itemname text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"></td><td class="itemquntity"><input type="text" name="itemquntity[]" class="  text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"></td><td class="itemprice"><input name="itemprice[]" type="text" class="  text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"></td><td class="itemtotal"><input  name="total[]" type="text" class="  text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"></td><td><span class="button  bg-red-600 deleteitem">delete</span></td></tr>');
                });

                $(document).on('click','.deleteitem',function(e){
                    e.preventDefault();
                    $(this).parents('tr').remove();
                    discount = $('#discount').val();
                    tax = $("#tax").val();
                    console.log("d-->"+discount+" tax-->"+tax);
                    final(discount,tax);

                });


                $('#discount').keyup(function(){
                    di = $(this).val();
                    tax = $("#tax").val();
                    final(di,tax);
                });
                $('#tax').keyup(function(){
                    tax = $(this).val();
                    di = $("#discount").val();
                    final(di,tax);
                });

                $(document).on('keyup','.itemquntity input',function(){
                    var q = $(this).val();
                    var p = $(this).parents('tr').find('.itemprice').find('input').val();
                    $(this).parents('tr').find('.itemtotal').find('input').val(parseFloat(p)*parseFloat(q));
                    tax = $("#tax").val();
                    di = $("#discount").val();
                    final(di,tax);
                })

                $(document).on("click",".itemname",function(){
                    var x = this;
                    $(x).autocomplete({
                        source : function(request,response){
                            var value = request.term;
                            // console.log(value); // console.log(value);
                            // $.ajaxSetup({
                            //     headers:
                            //     { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                            // });

                            $.ajax({
                                url:"/quotation/search",
                                method:"get",
                                data:{value:value},
                                dataType: "json",
                                success:function(data){

                                    response(data);

                                }

                                })
                        },

                        select: function (event, ui) {
                            $(x).val(ui.item.label);
                            console.log(ui.item.quntity)
                            console.log(ui.item.price)
                            console.log(ui.item.total)
                            console.log(ui.item.value)
                            $(x).parents('tr').find('.itemquntity').find('input').val(ui.item.quntity)
                            $(x).parents('tr').find('.itemprice').find('input').val(ui.item.price)
                            $(x).parents('tr').find('.itemtotal').find('input').val(ui.item.total)
                            $(x).parents('tr').find('.itemsid').find('input').val(ui.item.value)
                            discount = $('#discount').val();
                            tax = $("#tax").val();
                            final(discount,tax);
                            return false;
                        }

                });
            })
        });
     </script>

    @endsection
</x-app-layout>
