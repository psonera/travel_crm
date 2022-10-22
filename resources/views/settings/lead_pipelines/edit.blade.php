<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Edit Lead Pipeline</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST"
                        action="{{ route('settings.lead_pipelines.update', $lead_pipeline) }}">
                        @csrf
                        <div class="mb-4">
                            <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ $lead_pipeline->name }}"
                                autocomplete="name" autofocus />
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <div class="mb-4">
                            Default
                            <div
                                class="custom-control custom-radio flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                <input id="yes" type="radio" value="1" name="is_default"
                                    @if (old('is_default') == '1' || $lead_pipeline->is_default == '1') checked @endif
                                    class="custom-control-input w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="yes"
                                    class="custom-control-label py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Yes</label>
                            </div>
                            <div
                                class="custom-control custom-radio flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                <input id="no" type="radio" value="0" name="is_default"
                                    @if (old('is_default') == '0' || $lead_pipeline->is_default == '0') checked @endif
                                    class="custom-control-input w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="no"
                                    class="custom-control-label py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                            </div>
                        </div>


                        <div class="mb-4">
                            <x-inputs.text name="rotten_days" label="{{ __('Expiry Days') }}"
                                value="{{ $lead_pipeline->rotten_days }}" autofocus />
                        </div>
                        @error('stagename.*')
                            <p class="text-red-500 text-xl mt-1">Fill All Stages</p>
                        @enderror

                        @error('stageper.*')
                            <p class="text-red-500 text-xl mt-1">Fill All Probabiltiy</p>
                        @enderror
                        <div>
                            <leadpipelineitem old_value="{{ json_encode(old()) }}"
                                editvalue="{{ $lead_pipeline->leadStages }}"></leadpipelineitem>
                        </div>


                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                Edit Lead Pipeline</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
