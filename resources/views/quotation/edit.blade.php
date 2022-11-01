<x-app-layout>
    @section('title','Edit Quotation')
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
                    <h2 class="text-3xl font-bold">Create Quotation</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('quotations.update', ['id' => $quotation->id]) }}">
                        @csrf
                            <Tabs>
                                <Tab name="Quotation Detail" >
                                    <div class="p-4">
                                    @if (auth()->user()->hasRole('manager'))

                                    @else
                                    <div class="mb-4">
                                        @if ($quotation->user_id==null)
                                        <manager :old_value="{{json_encode(old('owner'))}}"></manager>
                                        <div>
                                            <span class="text text-red-700 text-lg">{{$errors->first('owner')}}</span>
                                        </div>
                                        @else
                                            <manager
                                                manager="{{$quotation->user->id}}"
                                                :old_value="{{json_encode(old('owner'))}}">
                                            </manager>
                                            <div>
                                                <span class="text text-red-700 text-lg">{{$errors->first('owner')}}</span>
                                            </div>
                                        @endif
                                    </div>
                                    @endif

                                    <div class="mb-4">
                                        @php
                                            $sub = $quotation->subject
                                        @endphp
                                        <subject subject="{{$sub}}" :old_value="{{json_encode(old('subject'))}}"></subject>
                                        <div>
                                            <span class="text text-red-700 text-lg">{{$errors->first('subject')}}</span>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        @php
                                            $des = $quotation->description
                                        @endphp

                                        <description description="{{$des}}" :old_value="{{json_encode((old('description')))}}"></description>
                                        <div>
                                            <span class="text text-red-700 text-lg">{{$errors->first('description')}}</span>
                                        </div>
                                    </div>

                                    @if (auth()->user()->hasRole('lead-manager'))
                                    @else
                                        <div class="mb-4">
                                            @if ($quotation->lead_manager_id==null)
                                                <leadmanager :oldvalue='@json(old())'></leadmanager>
                                            @else
                                                <leadmanager :oldvalue='@json(old())' lead_manager="{{$quotation->leadManager}}"></leadmanager>
                                            @endif
                                            @if ($errors->has('lead_manager'))
                                                <div class="text-red-500">Lead Manager Required</div>
                                        @endif
                                        @if ($errors->has('r_lead_manager'))
                                                <div class="text-red-500"><strong>Only Search and Select</strong>  </div>
                                        @endif
                                        </div>
                                    @endif

                                    <div class="mb-4">
                                        @if ($quotation->lead_id==null)
                                            <leadname :oldvalue="Object({{json_encode(old())}})"></leadname>
                                        @else
                                            <leadname :oldvalue="{{json_encode(old())}}" :edit="true" lead="{{$quotation->lead}}"></leadname>
                                        @endif
                                        @if ($errors->has('lead'))
                                            <div class="text-red-500">Lead  Required</div>
                                        @endif
                                        @if ($errors->has('r_lead'))
                                            <div class="text-red-500"><strong>Only Search and Select</strong>  </div>
                                        @endif
                                    </div>
                                </div>
                                </Tab>
                                <Tab name="Address">
                                    <div class="p-4">
                                    <div class="mb-4">
                                        <addressvue
                                                   :address="{{$quotation->billing_address}}"
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
                                                  :address="{{$quotation->shipping_address}}"
                                                   title="Shipping Address"
                                                   addressname="shipping_address"
                                                   pinname="s_postcode"
                                                   contryname="s_contry"
                                                   statename="s_state"
                                                   cityname="s_city"
                                                   :oldvalue="{{json_encode(old())}}"
                                                   :errors="{{$errors}}">
                                        </addressvue>
                                   </div>
                                </div>
                                </Tab>
                                <Tab name="Quotation Item">
                                    <div class="p-4">
                                    <div class="mb-4 ">
                                        <div class="flex">
                                            <quotaionitem
                                                :oldvalue="{{json_encode(old())}}"
                                                :discount="String({{$quotation->discount_amount}})"
                                                :tax="String({{$quotation->tax_amount}})"
                                                :items="{{$quotation->quotationItems}}"
                                                :errors="{{$errors}}">
                                            </quotaionitem>
                                        </div>
                                    </div>
                                </div>
                                </Tab>
                                <div class="text-center">
                                    <button type="submit"
                                        class="inline-block px-6 py-3 mb-6 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">update
                                        As Quotation
                                    </button>
                                </div>
                            </Tabs>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('page_scripts')
        <script src="{{ mix('js/app.js') }}"></script>
    @endsection
</x-app-layout>
