<x-app-layout>
    @section('title', 'My Profile')
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
                    <h2 class="text-3xl font-bold">Edit Profile</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            @if (count($user->getMedia('profile_image')) > 0)
                                <imageupload image_url="{{$user->getMedia('profile_image')[0]->getUrl()}}"></imageupload>
                            @else
                                <imageupload></imageupload>
                            @endif
                        </div>
                        <div class="mb-4">
                            <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ $user->name }}" autocomplete="name" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.email name="email" label="{{ __('Email Address') }}" class="bg-gray-200" value="{{ $user->email }}" autofocus required disabled/>
                        </div>

                        <div class="mb-4">
                            <x-inputs.text name="phone" value="{{$user->phone_number}}" label="{{ __('Phone') }}"  required  autofocus />
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs triping-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                Update Profile</button>
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
