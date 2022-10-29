<x-app-layout>
    @section('title', 'Compose Mail')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Compose</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('mails.store') }}" enctype="multipart/form-data">
                        @csrf
                        <mailto></mailto>
                        @error('to')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        @error('cc')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        @error('bcc')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="mb-4">
                            <x-inputs.text name="subject" id="subject" label="{{ __('Subject') }}"
                                value="{{ old('subject') }}" required autocomplete="subject" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.textarea name="content" id='content' label="{{ __('Content') }}"
                                value="{{ old('content') }}"  autocomplete="content" >
                            </x-inputs.textarea>
                        </div>
                      
                        <div class="mb-4">
                            <label class="p-2 font-semibold text-gray-700">Attachments</label>
                            <attachment></attachment>
                        </div>
                        @error('attachment.*')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="text-center">
                            <button type="submit" name="save"
                                class="inline-block px-6 py-3 mt-6 mb-2 mr-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white fa fa-paper-plane-o">
                                Send
                            </button>
                            <button id='draft-btn' type="submit" name="save_as_draft"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                Save as Draft
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('page_scripts')
        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            var editor = new FroalaEditor('#content');
        </script>
    @endsection
</x-app-layout>
