<x-app-layout>
    @section('title', 'Create Lead')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Create Lead</h2>
                </div>
                <div class="flex-auto px-6 py-1">
                    <form role="form" method="POST" action="{{ route('leads.store') }}">
                        @csrf
                        <tabs>
                            <tab name="Details" :selected="true">
                                {{-- Details Section --}}
                                <div class="p-4">
                                    <div class="mb-4">
                                        <x-inputs.text name="title" label="{{ __('Title') }}"
                                                       value="{{ old('title') }}" required autocomplete="title" autofocus />
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.textarea name="description" label="{{ __('Lead Body') }}">
                                            {{ old('description') }}</x-inputs.textarea>
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.text name="lead_value" currencySymbol="true"
                                                       label="{{ __('Lead Value') }}" value="{{ old('lead_value') }}" required
                                                       autocomplete="lead_value" autofocus />
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.select name="lead_source_id" label="{{ __('Source') }}" required>
                                            <option value="">-- Select Lead Source --</option>
                                            @foreach ($sources as $source)
                                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                                            @endforeach
                                        </x-inputs.select>
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.select name="lead_type_id" label="{{ __('Type') }}" required>
                                            <option value="">-- Select Lead Type --</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </x-inputs.select>
                                    </div>

                                    <div class="mb-4">
                                        <find-manager data=""></find-manager>
                                    </div>
                                    @error('user_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror

                                    <div class="mb-4">
                                        <x-inputs.date name="expected_closed_date"
                                                       label="{{ __('Expected Close Date') }}" />
                                    </div>

                                    <input type="hidden" name="lead_pipeline_stage_id" value="{{ request('stage_id') ? request('stage_id') : 1;  }}" />

                                </div>
                            </tab>
                            <tab name="Trip">
                                {{-- Trip Section --}}
                                <div class="p-4">
                                    <find-trip data=""></find-trip>

                                    <div class="mb-4">
                                        <x-inputs.partials.label name="trip_type_id" label="Trip Type" required />
                                        <span class="text-red-500">*</span>
                                        @foreach ($trip_types as $trip_type)
                                            <div>
                                                <input
                                                    class="align-top bg-transparent border border-gray-300 checked:bg-blue-600 cursor-pointer float-left focus:ring-0 h-4 mr-2 mt-1 peer rounded-full w-4"
                                                    type="radio" name="trip_type_id" id="trip_type_id_{{ $trip_type->id }}" value="{{ $trip_type->id }}"
                                                    {{ $trip_type->id === 1 ? 'checked' : '' }}>
                                                <label class="form-check-label peer-checked text-gray-800"
                                                       for="trip_type_id_{{ $trip_type->id }}">{{ $trip_type->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.number name="traveler_count"
                                                         label="{{ __('How many travelers are you?') }}" autocomplete="traveler_count"
                                                         autofocus required />
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.date name="selected_trip_date" label="{{ __('Select Trip Date') }}"
                                                       autocomplete="selected_trip_date" autofocus />
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.partials.label name="accomodation_id" label="Accomodation" required />
                                        <span class="text-red-500">*</span>
                                        @foreach ($accomodations as $acc)
                                            <div>
                                                <input
                                                    class="align-top bg-transparent border border-gray-300 checked:bg-blue-600 cursor-pointer float-left focus:ring-0 h-4 mr-2 mt-1 peer rounded-full w-4"
                                                    type="radio" name="accomodation_id" id="accomodation_id_{{ $acc->id }}" value="{{ $acc->id }}"
                                                    {{ $acc->id === 1 ? 'checked' : '' }}>
                                                <label class="form-check-label peer-checked text-gray-800"
                                                       for="accomodation_id_{{ $acc->id }}">{{ $acc->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.partials.label name="transport_id" label="Choose Transportation"
                                                                 required />
                                        <span class="text-red-500">*</span>
                                        @foreach ($transports as $transport)
                                            <div>
                                                <input
                                                    class="align-top bg-transparent border border-gray-300 checked:bg-blue-600 cursor-pointer float-left focus:ring-0 h-4 mr-2 mt-1 peer rounded-full w-4"
                                                    type="radio" name="transport_id" id="transport_id_{{ $transport->id }}" value="{{ $transport->id }}"
                                                    {{ $transport->id === 1 ? 'checked' : '' }}>
                                                <label class="form-check-label peer-checked text-gray-800"
                                                        for="transport_id_{{ $transport->id }}">{{ $transport->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </tab>
                            <tab name="Lead Manager">
                                {{-- Lead Manager Section --}}
                                <div class="p-4">
                                    <find-lead-manager data=""></find-lead-manager>
                                </div>
                            </tab>
                            <tab name="Product">
                                {{-- Product Section --}}
                                <div class="p-4">
                                    <product-list :data='@json(old('products'))'></product-list>
                                </div>
                            </tab>
                        </tabs>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mb-6 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Save
                                as Lead</button>
                        </div>
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('page_scripts')
        <script src="{{ mix('js/app.js') }}"></script>
    @endsection
</x-app-layout>
