<x-app-layout>
    @section('title', 'Edit Role')

    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Edit Role</h2>
                </div>

                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('settings.roles.update',$role) }}">
                        @method('put')
                        @csrf
                            <div class="mb-4">
                                <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ $role->name }}" autocomplete="name" autofocus />
                            </div>


                            <div class="mb-4">
                                <x-inputs.text name="guard_name" label="{{ __('Guard Name') }}" value="{{ $role->guard_name }}" autocomplete="guard_name" autofocus />
                            </div>

                            <div>
                                <permission old_value="{{json_encode(old('permission'))}}" :dp="{{$role->getAllPermissions()}}" permissions="{{$permissions}}"></permission>
                            </div>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs triping-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                Edit Role</button>
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
