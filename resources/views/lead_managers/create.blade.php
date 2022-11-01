<x-app-layout>
    @section('title', 'Create Lead Manager')
    @section('page_styles')
        <style>
            img.userimg {
                max-height: 200px;
                max-width: 200px;
            }
        </style>
    @endsection

    <div class="flex flex-wrap -mx-3">

        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Create Lead Manager</h2>

                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('lead_managers.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <imageupload></imageupload>
                        </div>
                        @error('profile_image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <div class="mb-4">
                            <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ old('name') }}"
                                required autocomplete="name" autofocus  />
                        </div>

                        <div class="mb-4">
                            <x-inputs.email name="email" label="{{ __('Email Address') }}" value="{{ old('email') }}"
                                required autocomplete="email" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.text name="phone" label="{{ __('Phone') }}" value="{{ old('phone') }}"
                                required autofocus />
                        </div>

                        @if (auth()->user()->hasRole('manager'))
                        @else
                            <usermanager></usermanager>
                            @error('manager')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            @error('r_manager')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        @endif
                        <div class="mb-4">
                            <label for="" class="label label-required pb-2 font-medium text-gray-700">Lead
                                Source</label>
                            <select name="leadsource" id=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg f w-full dark:text-black m-0.5 p-1.5">
                                <option value="">Select Source</option>
                                @foreach ($leadsources as $leadsource)
                                    <option value="{{ $leadsource->id }}">{{ $leadsource->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('leadsource')

                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <div class="mb-4">
                            <x-inputs.password name="password" class="js-password" label="{{ __('Password') }}"
                                autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.password label="{{ __('Confirm Password') }}" id="password-confirm"
                                name="password_confirmation" required autocomplete="new-password" autofocus />
                        </div>

                        <div class="mb-4">
                            Status
                            <div class="flex items-center pl-4 rounded border">
                                <input id="yes" type="radio" value="1" name="status"
                                    class="w-4 h-4  bg-gray-100 border-gray-300   m-2" checked>
                                <span class="m-2 text-gray-500 font-bold">Active</span>
                                <input id="no" type="radio" value="0" name="status"
                                    class="w-4 h-4  bg-gray-100 border-gray-300   m-2">
                                <span class="m-2 text-gray-500 font-bold">Inactive</span>
                            </div>
                        </div>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Add
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('page_scripts')
        <script src="{{ mix('js/app.js') }}"></script>
    @endsection
</x-app-layout>
