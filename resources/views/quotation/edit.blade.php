<x-app-layout>
    @if ($errors->any())
        <div id="alert-2" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
            <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                You Might forgot Some Field
            </div>
        </div>
    @endif
    <div class="flex flex-wrap -mx-3" id="quo">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Edit Quotation</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('quotations.update', ['id' => $quotation->id]) }}">
                        @csrf
                            <tabs>
                                <tab name="Details" :selected="true">
                                    <div class="p-4">
                                        <div class="mb-4">
                                            <manager
                                                    :manager="String({{$quotation->user->id}})"
                                                    :oldvalue="{{json_encode(old('owner'))}}"
                                                    ></manager>
                                                    <div>
                                                        <span class="text text-red-700 text-lg">{{$errors->first('owner')}}</span>
                                                    </div>
                                        </div>
                                        <div class="mb-4">
                                            @php
                                                $sub = $quotation->subject
                                            @endphp
                                            <subject subject="{{$sub}}" :oldvalue='@json(old('subject'))'></subject>
                                            <div>
                                                <span class="text text-red-700 text-lg">{{$errors->first('subject')}}</span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            @php
                                                $des = $quotation->description
                                            @endphp
                                            <description description="{{$des}}" :oldvalue='@json(old('description'))'></description>
                                            <div>
                                                <span class="text text-red-700 text-lg">{{$errors->first('description')}}</span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <leadmanager :oldvalue='@json(old())' leadmanagername="{{$quotation->leadManager->name}}"></leadmanager>
                                            <div>
                                                <span class="text text-red-700 text-lg">{{$errors->first('oldperson')}}</span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <leadname
                                            :oldvalue="{{json_encode(old())}}"
                                            leadname="{{$quotation->lead->title}}"
                                                ></leadname>
                                                <div>
                                                    <span class="text text-red-700 text-lg">{{$errors->first('oldlead')}}</span>
                                                </div>
                                        </div>
                                    </div>

                                </tab>
                                <tab name="Address">
                                    <div class="p-4">
                                        <div class="mb-4">
                                            <addressvue
                                                       :address="Object({{$quotation->billing_address}})"
                                                       title="Billing Address"
                                                       addressname="billing_address"
                                                       pinname="b_postcode"
                                                       contryname="b_contry"
                                                       statename="b_state"
                                                       cityname="b_city"
                                                       :oldvalue="{{json_encode(old())}}"
                                                       :errors="{{$errors}}"
                                                       ></addressvue>
                                                                           </div>
                                        
                                                                           <div class="mb-4">
                                            <addressvue
                                                      :address="Object({{$quotation->shipping_address}})"
                                                       title="Shipping Address"
                                                       addressname="shipping_address"
                                                       pinname="s_postcode"
                                                       contryname="s_contry"
                                                       statename="s_state"
                                                       cityname="s_city"
                                                       :oldvalue="{{json_encode(old())}}"
                                                       :errors="{{$errors}}"
                                                       ></addressvue>
                                                                           </div>
                                    </div>
                                </tab>
                                <tab name="Quotation Item">
                                    <div class="p-4">
                                        <div class="mb-4 ">
                                            <div class="flex">
                                                <quotaionitem
                                                :oldvalue="{{json_encode(old())}}"
                                                :discount="String({{$quotation->discount_amount}})"
                                                :tax="String({{$quotation->tax_amount}})"
                                                :items="{{$quotation->quotationItems}}"
                                                :errors="{{$errors}}"
                                                ></quotaionitem>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="inline-block px-6 py-3 mb-6 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Update
                                                Quotation
                                            </button>
                                        </div>
                                    </div>
                                </tab>
                            </tabs>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('page_scripts')
        <script src="{{ mix('js/app.js') }}"></script>
    @endsection
</x-app-layout>
