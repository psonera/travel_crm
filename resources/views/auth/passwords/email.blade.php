<x-login-layout>
    <section>
        <div class="relative flex items-center p-0 overflow-hidden bg-center bg-cover min-h-75-screen">
            <div class="container z-10">
                <div class="flex flex-wrap mt-0 -mx-3">
                    <div
                        class="flex flex-col w-full max-w-full px-3 mx-auto md:flex-0 shrink-0 md:w-6/12 lg:w-5/12 xl:w-4/12">
                        <div
                            class="relative flex flex-col min-w-0 mt-32 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                           	<section class="grid" >

                                    <div class="grid-cols-1" >
                                    <div class="">
                                        @if (session('status'))
                                            <div class="relative px-3 py-3 mb-4 border rounded text-green-800" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <x-partials.card >
                                            <div class=" flex justify-center">
                                                <span class="text-3xl font-bold mb-3 text-blue-700 font-bold">{{ __('Reset Password') }}</span>
                                            </div>

                                            <div class="flex justify-center ">

                                                <form method="POST"  action="{{ route('password.email') }}" class="w-full flex justify-center ">
                                                    @csrf
                                                        {{-- <label for="email" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('E-Mail Address') }}</label> --}}

                                                        <div class="w-full pr-4 pl-4 ">
                                                            <x-inputs.email name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" label="Email" autofocus/>

                                                            @error('email')
                                                                <span class="hidden mt-1 text-sm text-red" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <div class="mb-10 mt-5 flex justify-center ">
                                                                <div >
                                                                    <button type="submit" class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-black uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white bg-blue-500">
                                                                        {{ __('Send Password Reset Link') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </form>
                                            </div>
                                        </x-partials.card>
                                    </div>
                                    </div>
                             </section>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 lg:flex-0 shrink-0 md:w-6/12">
                    <div
                        class="absolute top-0 hidden w-3/5 h-full -mr-32 overflow-hidden -skew-x-10 -right-40 rounded-bl-xl md:block">
                        <div class="absolute inset-x-0 top-0 z-0 h-full -ml-16 bg-cover skew-x-10"
                            style="background-image: url('/img/curved-images/curved6.jpg')"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-login-layout>
