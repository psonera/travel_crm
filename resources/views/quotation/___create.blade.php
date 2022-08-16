<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0
            border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
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
                                <livewire:selectmanager />
                            </div>
                            @error('owner')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
