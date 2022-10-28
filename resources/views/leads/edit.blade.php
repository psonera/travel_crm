<x-app-layout>
    @section('title', 'Edit Lead')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Edit Lead</h2>
                </div>
                <div class="flex-auto px-6 py-1">
                    <form role="form" method="POST" action="{{ route('leads.update', $lead->id) }}">
                        @csrf
                        <tabs>
                            <tab name="Details" :selected="true">
                                {{-- Details Section --}}
                                <div class="p-4">
                                    <div class="mb-4">
                                        <x-inputs.text name="title" label="{{ __('Title') }}"
                                                       value="{{ old('title') ? old('title') : $lead->title }}" required autocomplete="title" autofocus />
                                    </div>
                                    
                                    <div class="mb-4">
                                        <x-inputs.textarea name="description" label="{{ __('Lead Body') }}">
                                            {{ old('description') ? old('description') : $lead->description }}</x-inputs.textarea>
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.text name="lead_value" currencySymbol="true"
                                                       label="{{ __('Lead Value') }}" value="{{ old('lead_value') ? old('lead_value') : $lead->lead_value }}" required
                                                       autocomplete="lead_value" autofocus />
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.select name="lead_source_id" label="{{ __('Source') }}" required>
                                            <option value="">-- Select Lead Source --</option>
                                            @foreach ($sources as $source)
                                                <option value="{{ $source->id }}" {{ (old('lead_source_id') ? old('lead_source_id') : $lead->lead_source_id === $source->id) ? 'selected' : '' }}>{{ $source->name }}</option>
                                            @endforeach
                                        </x-inputs.select>
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.select name="lead_type_id" label="{{ __('Type') }}" required>
                                            <option value="">-- Select Lead Type --</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}" {{ (old('lead_type_id') ? old('lead_type_id') : $lead->lead_type_id === $type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </x-inputs.select>
                                    </div>

                                    <div class="mb-4">
                                        <find-manager data="{{ $lead->user }}"></find-manager>
                                    </div>
                                    @error('user_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror

                                    <div class="mb-4">
                                        <x-inputs.date name="expected_closed_date" value="{{ old('expected_closed_date') ? old('expected_closed_date') : $lead->expected_closed_date->format('Y-m-d') }}"
                                                       label="{{ __('Expected Close Date') }}" />
                                    </div>

                                    <input type="hidden" name="lead_pipeline_stage_id" value="{{ $lead->lead_pipeline_stage_id }}" />

                                </div>
                            </tab>
                            <tab name="Trip">
                                {{-- Trip Section --}}
                                <div class="p-4">
                                    <find-trip data="{{ $lead->trip }}"></find-trip>

                                    <div class="mb-4">
                                        <x-inputs.partials.label name="trip_type_id" label="Trip Type" required />
                                        <span class="text-red-500">*</span>
                                        @foreach ($trip_types as $trip_type)
                                            <div class="flex">
                                                <input
                                                    class="align-top bg-transparent border border-gray-300 checked:bg-blue-600 cursor-pointer float-left focus:ring-0 h-4 mr-2 mt-1 peer rounded-full w-4"
                                                    type="radio" name="trip_type_id" value="{{ $trip_type->id }}" id="trip_type_id_{{ $trip_type->id }}"
                                                    {{  (old('trip_type_id') ? old('trip_type_id') : $lead->trip_type_id === $trip_type->id) ? 'checked' : '' }}>
                                                <label class="form-check-label peer-checked text-gray-800"
                                                       for="trip_type_id_{{ $trip_type->id }}">{{ $trip_type->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('trip_type_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror

                                    <div class="mb-4">
                                        <x-inputs.number name="traveler_count"
                                                         label="{{ __('How many travelers are you?') }}" value="{{ old('traveler_count') ? old('traveler_count') : $lead->traveler_count }}" autocomplete="traveler_count"
                                                         autofocus required />
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.date name="selected_trip_date" label="{{ __('Select Trip Date') }}"
                                                       autocomplete="selected_trip_date" value="{{ old('selected_trip_date') ? old('selected_trip_date') : $lead->selected_trip_date->format('Y-m-d') }}" autofocus />
                                    </div>

                                    <div class="mb-4">
                                        <x-inputs.partials.label name="accomodation_id" label="Accomodation" required />
                                        <span class="text-red-500">*</span>
                                        @foreach ($accomodations as $acc)
                                            <div>
                                                <input
                                                    class="align-top bg-transparent border border-gray-300 checked:bg-blue-600 cursor-pointer float-left focus:ring-0 h-4 mr-2 mt-1 peer rounded-full w-4"
                                                    type="radio" name="accomodation_id" value="{{ $acc->id }}" id="accomodation_id_{{ $acc->id }}"
                                                    {{ (old('accomodation_id') ? old('accomodation_id') : $lead->accomodation_id === $acc->id) ? 'checked' : '' }}>
                                                <label class="form-check-label peer-checked text-gray-800"
                                                       for="accomodation_id_{{ $acc->id }}">{{ $acc->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('accomodation_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror

                                    <div class="mb-4">
                                        <x-inputs.partials.label name="transport_id" label="Choose Transportation"
                                                                 required />
                                        <span class="text-red-500">*</span>
                                        @foreach ($transports as $transport)
                                            <div>
                                                <input
                                                    class="align-top bg-transparent border border-gray-300 checked:bg-blue-600 cursor-pointer float-left focus:ring-0 h-4 mr-2 mt-1 peer rounded-full w-4"
                                                    type="radio" name="transport_id" value="{{ $transport->id }}" id="transport_id_{{ $transport->id }}"
                                                    {{ (old('transport_id') ? old('transport_id') : $lead->transport_id === $transport->id) ? 'checked' : '' }}>
                                                <label class="form-check-label peer-checked text-gray-800"
                                                       for="transport_id_{{ $transport->id }}">{{ $transport->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('transport_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </tab>
                            <tab name="Lead Manager">
                                {{-- Lead Manager Section --}}
                                <div class="p-4">
                                    <find-lead-manager data="{{ $lead->leadManager }}"></find-lead-manager>
                                </div>
                            </tab>
                            <tab name="Product">
                                {{-- Product Section --}}
                                <div class="p-4">
                                    <product-list data="{{ $lead->leadProducts }}"></product-list>
                                </div>
                            </tab>
                        </tabs>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mb-6 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Update Lead</button>
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
