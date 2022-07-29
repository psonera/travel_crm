<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Create Lead</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST">
                        @csrf
                        <fieldset class="border border-solid border-gray-300 p-6">
                            <legend class="text-xl pl-4 pr-4">Details</legend>

                            <div class="mb-4">
                                <x-inputs.text name="title" label="{{ __('Title') }}" value="{{ old('title') }}"
                                    required autocomplete="title" autofocus />
                            </div>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.textarea name="description" label="{{ __('Lead Body') }}">
                                    {{ old('description') }}</x-inputs.textarea>
                            </div>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.text name="lead_value" currencySymbol="true" label="{{ __('Lead Value') }}"
                                    value="{{ old('lead_value') }}" required autocomplete="lead_value" autofocus />
                            </div>
                            @error('lead_value')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.select name="lead_source_id" label="{{ __('Source') }}" required>
                                    <option value="">-- Select Lead Source --</option>
                                    @foreach ($sources as $source)
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
                                    @foreach ($types as $type)
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
                                    @foreach ($managers as $manager)
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

                        <fieldset class="border border-solid border-gray-300 p-6 mt-12">
                            <legend class="text-xl pl-4 pr-4">Lead Manager Details</legend>

                            <div class="mb-4">
                                <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ old('name') }}"
                                    required autocomplete="name" autofocus />
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.email name="email" label="{{ __('Email') }}" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus />
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.text name="phone" label="{{ __('Phone') }}" value="{{ old('phone') }}"
                                    autocomplete="phone" autofocus />
                            </div>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                        </fieldset>

                        <fieldset class="border border-solid border-gray-300 p-6 mt-12">
                            <legend class="text-xl pl-4 pr-4">Products</legend>
                            @livewire('search-product')
                        </fieldset>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Save
                                as Lead</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var i = 0;
            $("#add_product").click(function() {
                ++i;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    beforeSend: function(xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    data: {
                        i: i,
                    },
                    url: "{{ route('leads.add_product') }}",
                    success: function(res) {
                        $('#add_product_form').append(res.html);
                    }
                });
            });
            $(document).on('click', '.delete-item', function() {
                var id = $(this).data('id');
                $('.add_product_form_' + id).remove();
            });
        });
    </script>
</x-app-layout>
