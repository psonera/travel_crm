<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Edit Trip</h2>

                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('settings.trips.update', $trip) }}">
                        @csrf

                        <div class="mb-4">
                            <x-inputs.text name="title" label="{{ __('Title') }}" value="{{ $trip->title }}"
                                required autocomplete="title" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.textarea name="description" label="{{ __('Description') }}">
                                {!! $trip->description !!}</x-inputs.textarea>
                        </div>

                        <div class="mb-4">
                            <x-inputs.text name="location" label="{{ __('Location') }}" value="{{ $trip->location }}"
                                required autocomplete="location" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.date name="start_date" label="{{ __('start_date') }}"
                                value="{{ Carbon\Carbon::parse($trip->start_date)->format('Y-d-m') }}" required
                                autocomplete="start_date" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.date name="end_date" label="{{ __('end_date') }}"
                                value="{{ Carbon\Carbon::parse($trip->end_date)->format('Y-d-m') }}" required
                                autocomplete="end_date" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.text name="batch_size" label="{{ __('batch_size') }}"
                                value="{{ $trip->batch_size }}" required autocomplete="batch_size" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.text name="price" label="{{ __('Price') }}" currencySymbol="true"
                                value="{{ $trip->price }}" required autocomplete="price" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.select name="trip_type_id" label="{{ __('Trip Type') }}" required>
                                <option value="">-- Select Trip Type --</option>
                                @foreach (App\Models\TripType::all() as $trip_type)
                                    <option value="{{ $trip_type->id }}"
                                        {{ $trip->trip_type_id === $trip_type->id ? ' selected' : '' }}>
                                        {{ $trip_type->name }}</option>
                                @endforeach
                            </x-inputs.select>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Edit
                                Trip</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('page_scripts')
        <script>
            var editor = new FroalaEditor('#description');
        </script>
    @endsection
</x-app-layout>
