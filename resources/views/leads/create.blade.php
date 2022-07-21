<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-xl font-bold">Create Lead</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST">
                        @csrf
                        <fieldset class="border border-solid border-gray-300 p-6">
                            <legend class="text-xl pl-4 pr-4">Details</legend>
                            <div class="mb-4">
                                <x-inputs.text name="title" label="{{ __('Title') }}" value="{{ old('title') }}" required autocomplete="title" autofocus />
                            </div>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.textarea name="lead_body" label="{{ __('Lead Body') }}">{{ old('lead_body') }}</x-inputs.textarea>
                            </div>
                            @error('lead_body')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.text name="lead_value" label="{{ __('Lead Value') }}" value="{{ old('lead_value') }}" required autocomplete="title" autofocus />
                            </div>
                            @error('lead_value')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.select name="lead_source_id" label="{{ __('Source') }}" required>
                                    <option value="">-- Select Lead Source --</option>
                                    @foreach (App\Models\LeadSource::all() as $source)
                                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                                    @endforeach
                                </x-inputs.select>
                            </div>
                            @error('lead_source_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.select name="lead_type_id" label="{{ __('Type') }}" required>
                                    <option value="">-- Select Lead Type --</option>
                                    @foreach (App\Models\LeadType::all() as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </x-inputs.select>
                            </div>
                            @error('lead_type_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.select name="lead_manager_id" label="{{ __('Lead Manager') }}" required>
                                    <option value="">-- Select Lead Manager --</option>
                                    @foreach (App\Models\LeadManager::all() as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </x-inputs.select>
                            </div>
                            @error('lead_manager_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                               <x-inputs.date name="expected_closed_date" label="{{ __('Expected Closed Date') }}" />
                            </div>
                            @error('expected_closed_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            
                        </fieldset>
                        
                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Add
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
