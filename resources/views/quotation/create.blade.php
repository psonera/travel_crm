<x-app-layout >

    @if ($errors->any())
    <div id="alert-2" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
        <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
            You Might forgot Some Field
        </div>
    </div>
    @endif
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Create Quotation</h2>
                </div>
                <div class="flex-auto p-6 py-1">
                    <form  role="form" method="POST" action="{{ route('quotations.store') }}">
                        @csrf
                            <tabs >
                                <tab name="Details" :selected="true">
                                    <div class="p-4">
                                        <div class="mb-4">
                                            <manager :oldvalue="{{json_encode(old('owner'))}}"></manager>
                                            <div>
                                                <span class="text text-red-700 text-lg">{{$errors->first('owner')}}</span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                        <subject :oldvalue='@json(old('subject'))'></subject>
                                        <div>
                                            <span class="text text-red-700 text-lg">{{$errors->first('subject')}}</span>
                                        </div>
                                        </div>
                                        <div class="mb-4">
                                            <description :oldvalue='@json(old('description'))'></description>
                                        <div>
                                            <span class="text text-red-700 text-lg">{{$errors->first('description')}}</span>
                                        </div>
                                        </div>
                                        <div class="mb-4" >
                                            <leadmanager :oldvalue='@json(old())'></leadmanager>
                                            <div>
                                                <span class="text text-red-700 text-lg">{{$errors->first('oldperson')}}</span>
                                            </div>
                                        </div>
                                        <div class="mb-4" >
                                            <leadname :oldvalue="{{json_encode(old())}}"></leadname>
                                            <div>
                                                <span class="text text-red-700 text-lg">{{$errors->first('oldlead')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </tab>
                                <tab name="Address" >
                                    <div class="p-4">
                                        <div class="mb-4">
                                            <addressvue
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
                                <tab name ="Quotation Item" >
                                    <div class="p-4">
                                        <div class="mb-4">
                                            <div class="flex">
                                                <quotaionitem :errors="{{$errors}}" :oldvalue="{{json_encode(old())}}">
                                                </quotaionitem>
                                            </div>
                                        </div>
                                    </div>
                                </tab>
                                <div class="text-center">
                                    <button type="submit"
                                        class="inline-block px-6 py-3 mb-6 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Save
                                        Quotation
                                    </button>
                                </div>
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
