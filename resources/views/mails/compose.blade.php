<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Compose</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('mails.store') }}" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border border-solid border-gray-300 p-6">
                            <legend class="text-xl pl-4 pr-4">Details</legend>
                            <div class="mb-4">
                                <x-inputs.email name="to" id='to' label="{{ __('To') }}" value="{{ old('to') }}" required autocomplete="to" autofocus />
                            </div>
                            
                            {{-- <button onclick="myFunction()">CC</button>
                            <div id="CC">
                                <x-inputs.email name="cc" value="{{ old('cc') }}" autocomplete="cc" autofocus />
                            </div> --}}
                            {{-- <button onclick="myFunction1()">BCC</button>
                            <div id="BCC">
                                <x-inputs.email name="bcc" label="{{ __('BCC') }}" value="{{ old('bcc') }}" autocomplete="bcc" autofocus />
                            </div> --}}

                            <div class="mb-4">
                                <x-inputs.text name="subject" id="subject" label="{{ __('Subject') }}" value="{{ old('subject') }}" required autocomplete="subject" autofocus />
                            </div>
                            @error('subject')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.select name="email_template" label="{{ __('Email Template') }}">
                                    <option value="">-- Select Email Template --</option>
                                    @foreach ($templates as $template)
                                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                                    @endforeach
                                </x-inputs.select>
                            </div>

                            <div class="mb-4">
                                <x-inputs.textarea name="content" id='content' label="{{ __('Content') }}" value="{{ old('content') }}" required autocomplete="content" autofocus></x-inputs.textarea>
                            </div>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                      
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="attachment">Upload Attachments</label>
                            <input type="file" name="attachment" id="attachment" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </fieldset>
                        
                        <div class="text-center">
                            <button type="submit" name="save"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white fa fa-paper-plane-o">
                                Send
                            </button>
                            
                        </div>
                    </form>
                    <button id='draft-btn'  
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                Save as Draft
                            </button>
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {

    $('#email_template').on('change',function() {
        var email_template = $('#email_template').val();
        $.ajax({
        method: 'GET',
            url: "/settings/email_templates/"+email_template,
            dataType: 'json',
                success: function(response) {
                    email_template = response.email;
                    $('#subject').val(email_template.subject);
                    $('#content').val(email_template.content);
                }
                }
            ); 
    });

    $('#draft-btn').on("click",function(){
    var mail=$('#draft-btn').attr('data-id');

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
                to : $('#to').val(),
                subject : $('#subject').val(),
                content : $('#content').val(),
                            
            },
            url: "draft",
            dataType: 'json',
                success: function(response) {
                    window.location.href = "{{ route('mails.draft')}}";
                }
                }
            );
            });
});
 
 
</script>
</x-app-layout>