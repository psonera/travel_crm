<x-app-layout>
    @section('title', 'Edit User')
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
                    <h2 class="text-3xl font-bold">Edit User</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('settings.users.update',$user) }}" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-4">
                                @if (count($user->getMedia('media')) > 0)
                                    <imageupload image_url="{{$user->getMedia('media')[0]->getUrl()}}"></imageupload>
                                @else
                                    <imageupload ></imageupload>
                                @endif
                            </div>
                            <div class="mb-4">
                                <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ $user->name }}" autocomplete="name" autofocus />
                            </div>

                            <div class="mb-4">
                                <x-inputs.email name="email" label="{{ __('Email Address') }}" value="{{ $user->email }}" autofocus readonly="true"/>
                            </div>
                                    <div class="mb-4">
                                        <label class="label label-required pb-2 font-medium text-gray-700">Roles<span class="text-red-500">*</span></label>
                                        <selectrole
                                        manager="{{ App\Models\User::select('id','name')->find($user->authorize_person) }}"
                                        selected="{{count($user->roles) > 0 ? $user->roles[0]->id :0}}"
                                        selected_source="{{$user->lead_source_id}}"
                                        oldvalue="{{json_encode(old('role'))}}"
                                        error="{{$errors->first('r_manager')}}" error2="{{$errors->first('manager')}}"></selectrole>
                                    </div>
                            @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.text name="phone" value="{{$user->phone_number}}" label="{{ __('Phone') }}"  required  autofocus />
                            </div>
                            <div class="mb-4">
                                Status
                                <div class="custom-control custom-radio flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input id="yes" type="radio" value="1" name="status" class="w-4 h-4  bg-gray-100 border-gray-300   m-2" @if(old('status') == '1' || $user->status == '1') checked @endif >
                                    <span class="m-2 text-gray-500 font-bold">Active</span>

                                    <input id="no" type="radio" value="0" name="status" class="w-4 h-4  bg-gray-100 border-gray-300   m-2" @if(old('status') == '0' || $user->status == '0') checked @endif>
                                    <span class="m-2 text-gray-500 font-bold">Inactive</span>
                                </div>
                            </div>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                        <div class="text-center">
                            <button type="submit" name="user_update"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs triping-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                Edit User</button>
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
